<?php

namespace App\Services;

use App\Helpers\FileHelper;
use App\Models\Candidate;
use App\Models\Language;
use App\Models\Note;
use App\Models\Position;
use Carbon\Carbon;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Columns\TextColumn;
use IbrahimBougaoua\FilamentRatingStar\Actions\RatingStar;
use IbrahimBougaoua\FilamentRatingStar\Columns\RatingStarColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CandidateService
{
    public function blacklist(int $candidateId): void
    {
        $candidate = Candidate::find($candidateId);
        if (!$candidate) {
            throw new \Exception('Candidate not found', 404);
        }

        $candidate->update([
            'is_working' => Candidate::STATUS_BLACKLIST
        ]);
    }

    public function removeFromBlacklist(int $candidateId): void
    {
        $candidate = Candidate::find($candidateId);
        if (!$candidate) {
            throw new \Exception('Candidate not found', 404);
        }

        $candidate->update([
            'is_working' => Candidate::STATUS_NOT_WORKING
        ]);
    }

    public static function getFormSchema()
    {
        return [
            TextInput::make('first_name')
                ->required()
                ->label(__('admin_candidate.first_name')),
            TextInput::make('last_name')
                ->required()
                ->label(__('admin_candidate.last_name')),
            TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->label(__('admin_candidate.email')),
            TextInput::make('phone_number')
                ->label(__('admin_candidate.phone_number'))
                ->required()
                ->tel(),
            Select::make('sex')
                ->options([
                    'male' => __('admin_candidate.sex_male'),
                    'female' => __('admin_candidate.sex_female'),
                ])
                ->required()
                ->label(__('admin_candidate.sex')),
            DatePicker::make('date_of_birth')
                ->required()
                ->label(__('admin_candidate.date_of_birth')),
            Select::make('positions')
                ->options(Position::all()->pluck('name', 'id'))
                ->multiple()
                ->label(__('admin_candidate.position')),
            Select::make('languages')
                ->options(Language::all()->pluck('name', 'id'))
                ->label(__('admin_candidate.languages'))
                ->multiple(),
            TextInput::make('private_accommodation')
                ->label(__('admin_candidate.private_accommodation')),
            RatingStar::make('rating')
                ->label(__('admin_candidate.rating')),
            Checkbox::make('driving_license')
                ->label(__('admin_candidate.driving_license')),
            Checkbox::make('own_transport')
                ->label(__('admin_candidate.own_transport')),
            FileUpload::make('cv')
                ->label(__('admin_candidate.cv_upload'))
                ->getUploadedFileNameForStorageUsing(
                    fn (TemporaryUploadedFile $file, $record,callable $get): string => (string) Str::slug($get('first_name') . ' ' . $get('last_name')) . '-cv.' . $file->extension(),
                )
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ])
                ->downloadable(),
            Textarea::make('notes')
                ->visibleOn(['create'])
                ->label(__('admin_candidate.notes')),
            ToggleButtons::make('is_working')
                ->default(Candidate::STATUS_NOT_WORKING)
                ->options([
                    Candidate::STATUS_BLACKLIST => __('admin_candidate.yes'),
                    Candidate::STATUS_NOT_WORKING=> __('admin_candidate.no')
                ])
                ->colors([
                    Candidate::STATUS_BLACKLIST => 'success',
                    Candidate::STATUS_NOT_WORKING => 'primary',

                ])
                ->visibleOn(['create'])
                ->grouped()
                ->label(__('admin_candidate.blacklisted')),
            Section::make(__('admin_candidate.notes'))
                ->schema([
                    Placeholder::make('list')
                        ->label(' ')
                        ->content(function ($record){
                            return new HtmlString(FileHelper::list_notes($record));
                        }),
                ])->hiddenOn(['edit','create']),
            Section::make(__('admin_candidate.projects'))
                ->schema([
                    Placeholder::make('list')
                        ->label(' ')
                        ->content(function ($record){
                            return new HtmlString(FileHelper::list_projects($record));
                        }),
                ])->hiddenOn(['edit','create'])
        ];
    }

    public static function getTableSchema(): array
    {
        return [
            TextColumn::make('full_name')
                ->label(__('admin_candidate.full_name'))
                ->getStateUsing(function (Model $record) {
                    return $record->first_name . ' ' . $record->last_name;
                })
                ->searchable(['first_name', 'last_name'])
                ->sortable(),
            TextColumn::make('email')->label('E-mail')
                ->searchable()
                ->sortable()
                ->label(__('admin_candidate.email'))
                ->toggleable(),
            TextColumn::make('phone_number')
                ->label(__('admin_candidate.phone_number'))
                ->searchable()
                ->sortable()
                ->toggleable(),
            RatingStarColumn::make('rating')->size('sm')
                ->sortable()
                ->label(__('admin_candidate.rating'))
                ->toggleable(),
            TextColumn::make('driving_license')
                ->sortable()
                ->label(__('admin_candidate.driving_license'))
                ->alignCenter()
                ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No'),
            TextColumn::make('own_transport')
                ->sortable()
                ->alignCenter()
                ->label(__('admin_candidate.own_transport'))
                ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No'),
            TextColumn::make('private_accommodation')
                ->sortable()
                ->label(__('admin_candidate.private_accommodation'))
                ->limit(30)
                ->toggleable()
                ->tooltip(function (TextColumn $column): ?string {
                    $state = $column->getState();

                    if (strlen($state) <= $column->getCharacterLimit()) {
                        return null;
                    }

                    // Only render the tooltip if the column content exceeds the length limit.
                    return $state;
                }),
            TextColumn::make('date_of_birth')
                ->toggleable()
                ->sortable()
                ->label('Age')
                ->label(__('admin_candidate.date_of_birth'))
                ->formatStateUsing(fn($record) => Carbon::parse($record->date_of_birth)->age)
                ->searchable(),
            TextColumn::make('positions_names')
                ->sortable()
                ->label(__('admin_candidate.position')),
            TextColumn::make('languages_names')
                ->sortable()
                ->label(__('admin_candidate.languages'))
                ->toggleable(),
        ];
    }

    public static function created_notes_save($candidate, $notes)
    {
        if(empty($notes))return;
        $new_notes = new Note();
        $new_notes->candidate_id = $candidate->id;
        $new_notes->notes = $notes;
        $new_notes->user_id = auth()->id();
        $new_notes->save();
    }
}

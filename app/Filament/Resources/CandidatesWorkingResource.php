<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Actions\CandidateAddNotesAction;
use App\Filament\Resources\Actions\CandidateAddOrderAction;
use App\Filament\Resources\Actions\CandidateAddToBlacklistAction;
use App\Filament\Resources\Actions\CandidateOpenCvAction;
use App\Filament\Resources\Actions\CandidateViewAction;
use App\Helpers\FileHelper;
use App\Models\Language;
use App\Models\Note;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Get;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Candidate;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use HusamTariq\FilamentDatabaseSchedule\Filament\Columns\ActionGroup;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use IbrahimBougaoua\FilamentRatingStar\Actions\RatingStar;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use App\Filament\Resources\CandidatesResource\Pages;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use App\Filament\Resources\CandidatesResource\RelationManagers;
use App\Filament\Resources\CandidatesResource\RelationManagers\NotesRelationManager;
use App\Filament\Resources\CandidatesResource\RelationManagers\ProjectsRelationManager;
use App\Models\Position;
use App\Services\CandidateService;
use App\Services\OrderService;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use IbrahimBougaoua\FilamentRatingStar\Columns\RatingStarColumn;
use Illuminate\Validation\Rules\Can;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CandidatesWorkingResource extends Resource
{
    protected static ?string $model = Candidate::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationGroup = 'Candidates';

    protected static ?string $navigationLabel = 'Working';

    protected static ?string $slug = 'candidates-working';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
        // Section::make()
        //     ->schema([
        //         RatingStar::make('rating')
        //         ->label('Rating')
        //     ]),
        Section::make()
            ->schema(
                self::getFormSchema()
            ),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultPaginationPageOption(50)
            ->columns(CandidateService::getTableSchema())
            ->defaultSort('updated_at', 'desc')
            ->filters([
                Filter::make('status')
                    ->baseQuery(fn (Builder $query) => $query->where('is_working', Candidate::STATUS_WORKING))
                    ->form([]),
                SelectFilter::make('driving_license')
                    ->label(__('admin_candidate.driving_license'))
                    ->options([
                        '1' => __('admin_candidate.yes'),
                        '0' => __('admin_candidate.no'),
                    ]),
                SelectFilter::make('own_transport')
                    ->options([
                        '1' => __('admin_candidate.yes'),
                        '0' => __('admin_candidate.no'),
                    ]),
            ])
            ->deferFilters()
            ->actions([
                ActionGroup::make([
                    CandidateOpenCvAction::make(),
                    CandidateAddNotesAction::make(),
                    CandidateViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->tooltip(__('admin_candidate.edit'))
                        ->label(' '),
                    CandidateAddToBlacklistAction::make()
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            NotesRelationManager::class,
            ProjectsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkingCandidates::route('/'),
            'edit' => Pages\EditWorkingCandidates::route('/{record}/edit'),
        ];
    }

    public static function getFormSchema()
    {
        return [
            TextInput::make('first_name')
                ->label('First Name'),
            TextInput::make('last_name')
                ->label('Last Name'),
            TextInput::make('email')
                ->label('E-mail'),
            TextInput::make('phone_number')
                ->label('Phone Number')
                ->tel(),
            Select::make('sex')->options([
                'male' => 'Male',
                'female' => 'Female',
            ])->label('Sex'),
            DatePicker::make('date_of_birth')
                ->label('Date of Birth'),
            Select::make('positions')
                ->options(Position::all()->pluck('name', 'id'))
                ->multiple(),
            Select::make('languages')
                ->options(Language::all()->pluck('name', 'id'))
                ->multiple(),
            RatingStar::make('rating'),
            Checkbox::make('driving_license'),
            Checkbox::make('own_transport'),
            FileUpload::make('cv')
                ->label('CV Upload')
                ->getUploadedFileNameForStorageUsing(
                    fn (TemporaryUploadedFile $file, $record): string => (string) Str::slug($record->first_name . ' ' . $record->last_name) . '-cv.' . $file->extension(),
                )
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ])
                ->downloadable(),
            Hidden::make('is_working')
                ->default(Candidate::STATUS_WORKING)
                ->label('Is Working'),
            Section::make('Notes')
                ->schema([
                    Placeholder::make('list')
                        ->label(' ')
                        ->content(function ($record){
                            return new HtmlString(FileHelper::list_notes($record));
                        })
                ])->hiddenOn(['edit'])
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('admin_settings.working');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin_settings.candidates');
    }

    public static function getPluralLabel(): ?string
    {
        return __('admin_settings.candidates'); // TODO: Change the autogenerated stub
    }

}

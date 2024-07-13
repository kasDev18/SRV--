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
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
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
use Filament\Tables\Filters\Filter;
use IbrahimBougaoua\FilamentRatingStar\Columns\RatingStarColumn;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Tables\Filters\SelectFilter;

class CandidatesDuringRecruitmentResource extends Resource
{
    protected static ?string $model = Candidate::class;

    protected static ?string $navigationIcon = 'heroicon-s-arrow-path';

    protected static ?string $navigationGroup = 'Candidates';

    protected static ?string $navigationLabel = 'During recruitment';

    protected static ?string $slug = 'candidates-during-recruitment';

    protected static ?int $navigationSort = 2;

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
                CandidateService::getFormSchema()
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
                    ->baseQuery(fn (Builder $query) => $query->where('is_working', Candidate::STATUS_DURING_RECRUITMENT))
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
            'index' => Pages\ListDuringRecruitmentCandidates::route('/'),
            'edit' => Pages\EditDuringRecruitmentCandidates::route('/{record}/edit'),
        ];
    }
    public static function getNavigationLabel(): string
    {
        return __('admin_settings.during_recruitment');
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

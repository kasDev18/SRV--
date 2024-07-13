<?php

namespace App\Filament\Resources;

use App\Models\Language;
use App\Services\CandidateService;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Get;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Candidate;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use IbrahimBougaoua\FilamentRatingStar\Actions\RatingStar;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CandidatesResource\Pages;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use App\Filament\Resources\CandidatesResource\RelationManagers;
use App\Filament\Resources\CandidatesResource\RelationManagers\NotesRelationManager;
use App\Filament\Resources\CandidatesResource\RelationManagers\ProjectsRelationManager;

class CandidatesResource extends Resource
{
    protected static ?string $model = Candidate::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

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
            ->columns([
                TextColumn::make('full_name', 'Name')
                    ->getStateUsing(function (Model $record) {
                        return $record->first_name . ' ' . $record->last_name;
                    })
                    ->searchable(['first_name', 'last_name']),
                TextColumn::make('email')->label('E-mail')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('phone_number')
                    ->label('Phone Number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('date_of_birth')
                    ->toggleable()
                    ->label('Age')
                    ->formatStateUsing(fn($record) => Carbon::parse($record->date_of_birth)->age)
                    ->searchable(),
                TextColumn::make('languages_names')
                    ->label('Languages')
                    ->toggleable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->form(self::getFormSchema())
                    ->slideOver()
                    ->modalWidth('md'),
                Tables\Actions\EditAction::make()
                //     ->form(self::getFormSchema())
                //     ->slideOver()
                //     ->modalWidth('md')
                ,
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            NotesRelationManager::class,
            ProjectsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCandidates::route('/'),
            'edit' => Pages\EditCandidates::route('/{record}/edit'),
            'create' => Pages\CreateCandidates::route('/create'),
        ];
    }

    public static function getFormSchema()
    {
        return CandidateService::getFormSchema();
    }
}

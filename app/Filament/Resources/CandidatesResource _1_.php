<?php

namespace App\Filament\Resources;

use App\Models\Language;
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
        return $table
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
            TextInput::make('position')
                ->label('Position'),
            Select::make('languages')
                ->options(Language::all()->pluck('name', 'id'))
                ->multiple(),
            Grid::make('transport')
                ->schema([
                    Checkbox::make('driving_license')
                        ->label('Driving license')
                        ->live(),
                    FileUpload::make('driving_license')
                        ->image()
                        ->hidden(fn(Get $get) => !$get('driving_license')),
                ])
                ->columns(1)
                ->columnSpan(1),
            FileUpload::make('cv')
                ->label('CV Upload')
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ])
                ->downloadable(),
            Hidden::make('is_working')
                ->default(true)
                ->label('Is Working'),
        ];
    }
}

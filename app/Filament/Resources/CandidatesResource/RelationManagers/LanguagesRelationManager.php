<?php

namespace App\Filament\Resources\CandidatesResource\RelationManagers;

use App\Models\Language;
use App\Models\LanguageLevel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LanguagesRelationManager extends RelationManager
{
    protected static string $relationship = 'candidateLanguages';

    protected static ?string $title = 'Knowledge';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('language_id')
                    ->label('Language')
                    ->options(Language::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('language_level_id')
                    ->label('Level')
                    ->options(LanguageLevel::all()->pluck('name', 'id'))
                    ->searchable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('language.name'),
                Tables\Columns\TextColumn::make('languageLevel.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

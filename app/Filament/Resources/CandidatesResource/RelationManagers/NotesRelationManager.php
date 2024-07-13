<?php

namespace App\Filament\Resources\CandidatesResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use HusamTariq\FilamentDatabaseSchedule\Filament\Columns\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotesRelationManager extends RelationManager
{
    protected static string $relationship = 'notes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('notes')
                    ->required(),
                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->id()),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table->defaultPaginationPageOption(50)
            ->recordTitleAttribute('notes')
            ->columns([
                Tables\Columns\TextColumn::make('notes'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->tooltip('Edit'),
                    Tables\Actions\DeleteAction::make()
                        ->tooltip('Delete'),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

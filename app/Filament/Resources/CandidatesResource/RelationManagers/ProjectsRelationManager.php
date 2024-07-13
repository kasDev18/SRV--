<?php

namespace App\Filament\Resources\CandidatesResource\RelationManagers;

use App\Models\Candidate;
use App\Models\Customers;
use App\Models\Position;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Can;

class ProjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'projects';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('project_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextArea::make('project_description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('project_link')
                    ->required()
                    ->maxLength(255)
                    ->url(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table->defaultPaginationPageOption(50)
            ->recordTitleAttribute('project_title')
            ->columns([
                Tables\Columns\TextColumn::make('project_title')
                    ->words(4),
                Tables\Columns\TextColumn::make('customer_id')
                    ->label('Client')
                    ->formatStateUsing(fn($state)=>Customers::find($state)?->company_name),
                Tables\Columns\TextColumn::make('position')
                    ->default(0)
                    ->formatStateUsing(function ($record){
                        $candidate = Candidate::find($record->candidate_id);
                        $positions = $candidate->positions;
                        if(!$positions)return '';
                        $pos_name = Position::whereIn('id',$positions)->pluck('name')->toArray();


                        return implode(', ',$pos_name);
                    }),
                Tables\Columns\TextColumn::make('start_time')
                    ->formatStateUsing(fn($state)=>date_format(Carbon::make($state),'Y/m/d')),
                Tables\Columns\TextColumn::make('end_time')
                    ->formatStateUsing(fn($state)=>date_format(Carbon::make($state),'Y/m/d')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
//                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

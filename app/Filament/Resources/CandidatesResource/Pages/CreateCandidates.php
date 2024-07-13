<?php

namespace App\Filament\Resources\CandidatesResource\Pages;

use App\Filament\Resources\CandidatesNotWorkingResource;
use App\Filament\Resources\CandidatesResource;
use App\Models\Candidate;
use App\Services\CandidateService;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCandidates extends CreateRecord
{
    protected static string $resource = CandidatesResource::class;

    protected function getFormSchema(): array
    {
        return CandidateService::getFormSchema();
    }

    protected function getRedirectUrl(): string
    {
        return '/admin';
    }

    protected function handleRecordCreation(array $data): Model
    {
        $create = parent::handleRecordCreation($data);

        if(!empty($data['notes']))
        {
            $candidate = Candidate::where('email',$data['email'])->first();
            CandidateService::created_notes_save($candidate, $data['notes']);
        }
        return $create;
    }
}

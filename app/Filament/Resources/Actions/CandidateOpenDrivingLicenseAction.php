<?php

declare(strict_types=1);

namespace App\Filament\Resources\Actions;

use App\Models\Candidate;
use Filament\Tables\Actions\Action;

class CandidateOpenDrivingLicenseAction extends Action
{
    const ACTION_NAME = 'openDrivingLicense';

    public static function make($name = self::ACTION_NAME): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('View Driving license')
            ->url(fn (Candidate $candidate): string => $candidate->driving_license_link)
            ->visible(fn (Candidate $candidate): bool => !is_null($candidate->driving_license))
            ->openUrlInNewTab();
    }
}

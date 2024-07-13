<?php

declare(strict_types=1);

namespace App\Filament\Resources\Actions;

use App\Models\Candidate;
use App\Services\CandidateService;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\ViewAction;

class CandidateViewAction extends ViewAction
{
    const ACTION_NAME = 'viewCandidate';

    public static function make($name = self::ACTION_NAME): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(' ')
            ->tooltip(__('admin_candidate.view_candidate'))
            ->form(CandidateService::getFormSchema())
            ->slideOver()
            ->modalWidth('md');
    }
}

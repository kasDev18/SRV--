<?php

declare(strict_types=1);

namespace App\Filament\Resources\Actions;

use App\Models\Candidate;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;

class CandidateOpenCvAction extends Action
{
    const ACTION_NAME = 'openCv';

    public static function make($name = self::ACTION_NAME): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(' ')
            ->color(Color::rgb('rgb(255,91,91)'))
            ->icon('heroicon-o-document-text')
            ->tooltip(__('admin_candidate.view_cv'))
            ->url(fn (Candidate $candidate): string => $candidate->cv_link)
            ->visible(fn (Candidate $candidate): bool => !is_null($candidate->cv))
            ->openUrlInNewTab();
    }
}

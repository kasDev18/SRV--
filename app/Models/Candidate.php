<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use IbrahimBougaoua\FilamentSortOrder\Traits\SortOrder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Candidate extends Model
{
    use HasFactory;
    use SortOrder;

    protected $guarded = [];

    const STATUS_NOT_WORKING = '0';
    const STATUS_DURING_RECRUITMENT = '1';
    const STATUS_WORKING = '2';
    const STATUS_BLACKLIST = '3';

    protected $casts = [
        'languages' => 'array',
        'positions' => 'array',
        'projects' => 'array',
    ];

    protected $appends = [
        'languages_names',
        'positions_names',
        'projects_titles'
    ];

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class,'candidate_id');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Orders::class);
    }

    public function candidateLanguages()
    {
        return $this->hasMany(CandidateLanguage::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['first_name'] . ' ' . $attributes['last_name'],
        );
    }

    protected function fullLastName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['last_name'] . ', ' . $attributes['first_name'],
        );
    }

    protected function rating(): Attribute
    {
        return Attribute::make(
            set: fn (string|null $value) => intval($value),
        );
    }

    protected function cvLink(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['cv'] ? FileHelper::getEmbededLink($attributes['cv']) : '',
        );
    }

    public function getLanguagesNamesAttribute()
    {
        if ($this->languages) {
            $languages = cache()->remember(is_array($this->languages) ? collect($this->languages)->join(',') : $this->languages, 60 * 60, function () {
                return Language::whereIn('id', $this->languages)->pluck('name')->toArray();
            });
            return implode(', ', $languages);
        }
        return "";
    }

    public function getPositionsNamesAttribute()
    {
        if ($this->positions) {
            $key = 'positions_' . (is_array($this->positions) ? collect($this->positions)->join(',') : $this->positions);
            $positions = cache()->remember($key, 60 * 60, function () {
                return Position::whereIn('id', $this->positions)->pluck('name')->toArray();
            });
            return implode(', ', $positions);
        }
        return "";
    }

    public function getProjectsTitlesAttribute()
    {
        if ($this->projects) {
            return implode(', ', array_column($this->projects, 'title'));
        }

        return "";
    }
}

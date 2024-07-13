<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateLanguage extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function candidate() {
        return $this->belongsTo(Candidate::class);
    }
    public function language() {
        return $this->belongsTo(Language::class);
    }
    public function languageLevel() {
        return $this->belongsTo(LanguageLevel::class);
    }
}

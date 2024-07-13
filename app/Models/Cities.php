<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table ='cities';
    use HasFactory;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Countries::class,'country_id','id');
    }
}

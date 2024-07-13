<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table ='country';
    use HasFactory;

    protected $guarded =[];

    public function cities()
    {
        return $this->belongsTo(Cities::class,'id','country_id');
    }

}

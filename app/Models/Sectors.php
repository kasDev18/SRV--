<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sectors extends Model
{
    protected $table = 'sector';
    use HasFactory;

    protected $fillable = ['name'];

}

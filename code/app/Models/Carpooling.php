<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carpooling extends Model
{
    use HasFactory;


    protected $table = 'carpooling';

    protected $fillable = [
        'carpooling_time',
        'driver_id',
        'place_id'
    ];
}

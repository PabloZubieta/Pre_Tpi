<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_has_carpooling extends Model
{
    use HasFactory;


    protected $table = 'users_has_carpooling';

    protected $fillable = [
        'users_id',
        'carpooling_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_does_edt extends Model
{
    use HasFactory;

    protected $fillable = [
        'starting_hour',
        'finnishing_hour',
        'users_id',
        'edt_id'
    ];

    protected $table = 'users_does_edt';
}

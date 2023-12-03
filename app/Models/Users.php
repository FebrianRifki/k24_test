<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'date_of_birth', 'gender'
, 'ktp_number', 'photo', 'role'    ];

    use HasFactory;
}

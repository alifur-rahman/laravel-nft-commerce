<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDescription extends Model
{
    use HasFactory;
    public $timestamp = true;
    protected $table = 'user_descriptions';
    protected $fillable = [
        'address',
        'city',
        'zip_code',
        'state',
        'date_of_birth',
        'country_id',
        'user_id',
        'about_user'
    ];
}

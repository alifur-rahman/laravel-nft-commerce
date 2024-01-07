<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'facebook',
        'twitter',
        'skype',
        'whatsapp',
        'linkedin',
        'telegram'
    ];
}

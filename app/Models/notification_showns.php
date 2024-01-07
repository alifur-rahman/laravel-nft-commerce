<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification_showns extends Model
{
    use HasFactory;
    public $timestamp = true;
    protected $fillable = [
        'user_id',
        'notification_id'
    ];
}

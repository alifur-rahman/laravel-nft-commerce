<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'comment',
        'commented_by',
        'status',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorites extends Model
{
    use HasFactory;
    public $timestamp = true;
    protected $fillable = [
        'favorite_by',
        'asset_id'
    ];
}

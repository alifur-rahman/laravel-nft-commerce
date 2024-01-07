<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetRating extends Model
{
    use HasFactory;
    protected $table = 'asset_ratings';
    protected $fillable = [
        'id',
        'asset_id', 
        'rate', 
        'rating_by', 
        'created_at', 
        'created_at'
    ];
}

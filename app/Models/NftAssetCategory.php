<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftAssetCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'id ',
        'category',
        'description',
        'slug',
        'meta_tags',
        'created_at',
        'updated_at'
    ];
}

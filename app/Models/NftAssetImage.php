<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftAssetImage extends Model
{
    use HasFactory;
    public $timestamp = true;
    protected $table = 'nft_asset_images';
    protected $fillable = [
        'id ',
        'nft_asset_id',
        'image',
        'created_at',
        'updated_at'
    ];
}

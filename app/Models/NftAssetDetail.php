<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftAssetDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nft_asset_id',
        'levels',
        'properties',
        'states',
        'description',
        'slug',
        'meta_tags',
        'unblockable_content',
        'sensitive_content',
        'supply',
        'created_at',
        'updated_at',
    ];
}

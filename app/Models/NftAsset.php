<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftAsset extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'category_id',
        'sale_type',
        'contract_date',
        'url',
        'owner_id',
        'base_price',
        'bit_time',
        'blockchain',
        'price_symbol',
        'created_at',
        'updated_at',
        'sales_status',
        'token',
    ];

    public function images(){
        return $this->hasMany(NftAssetImage::class);
    } 
    public function details(){
        return $this->hasOne(NftAssetDetail::class);
    }

    public function category(){
        return $this->belongsTo(NftAssetCategory::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'owner_id');
    }
}

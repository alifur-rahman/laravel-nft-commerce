<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'asset_id',
        'bidder_id',
        'offer_price',        
        'status',
    ];
    public function user(){
        return $this->belongsTo(User::class,'bidder_id');
    }
    public function asset(){
        return $this->belongsTo(NftAsset::class);
    }
}

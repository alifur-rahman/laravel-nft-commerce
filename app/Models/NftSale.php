<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftSale extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'asset_id',
        'quantity',
        'time',
        'total_price',
        'order_status',
        'order_id'
    ];

}

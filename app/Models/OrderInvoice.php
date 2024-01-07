<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'invoice_number',
        'order_id',
        'saller_id',
        'buyer_id',
        'amount'
    ];
}

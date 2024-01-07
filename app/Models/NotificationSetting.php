<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    use HasFactory;
    public $timestamp = true;
    protected $fillable = [
        'user_id',
        'order_confirm',
        'new_item',
        'new_bid',
        'payment_card',
        'ending_bid',
        'approve_product',
    ];
}

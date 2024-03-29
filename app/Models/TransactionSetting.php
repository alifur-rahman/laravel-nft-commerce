<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class TransactionSetting extends Model
{
    public $timestamp = "true";
    protected $table = 'transaction_settings';
    use HasFactory;
    // user activity log---------------------------------------------------
    // package use spatie
    // log the change attributes for all events
    protected static $recordEvents = ['created', 'updated', 'deleted'];

    // Customize log description
    public function getDescriptionForEvent(string $eventName): string
    {
        $ip_address = request()->ip();
        return "The IP address $ip_address has been {$eventName} transaction setting";
    }

    protected $fillable = [
        'transaction_type',
        'min_transaction',
        'max_transaction',
        'charge_type',
        'limit_start',
        'limit_end',
        'kyc',
        'amount',
        'permission',
        'active_status',
        'created_at',
    ];
 
}

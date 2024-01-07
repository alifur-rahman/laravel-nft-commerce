<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'transaction_id',
        'transaction_type',
        'bank_account_id',
        'other_transaction_id',
        'block_chain',
        'crypto_name',
        'crypto_address',
        'amount',
        'crypto_amount',
        'charge',
        'charge_id',
        'approved_status',
        'approved_by',
        'approved_date',
        'ip_address'
    ];

    /*
    |----------------------------------------------------------------------
    | one to many relation with BankAccount Model
    |----------------------------------------------------------------------
    */
    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    /*
    |----------------------------------------------------------------------
    | one to one relation with OtherTransaction Model
    |----------------------------------------------------------------------
    */
    public function otherTransaction()
    {
        return $this->belongsTo(OtherTransaction::class);
    }
}

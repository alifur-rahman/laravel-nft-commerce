<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'invoice_id',
        'bank_account_id',
        'transaction_type',
        'invoice_id',
        'transaction_id',
        'block_chain',
        'crypto_name',
        'crypto_address',
        'amount',
        'crypto_amount',
        'charge',
        'approved_by',
        'approved_status',
        'note',
        'approved_date',
        'account',
        'charge',
        'approved_by',
        'bank_proof',
        'ip_address',
        'approved_status',
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

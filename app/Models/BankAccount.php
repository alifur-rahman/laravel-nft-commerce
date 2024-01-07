<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bank_name',
        'bank_ac_name',
        'bank_ac_number',
        'bank_swift_code',
        'bank_iban',
        'bank_address',
        'bank_country',
        'note',
        'approve_status',
        'status',
    ];

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class);
    }
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }


}

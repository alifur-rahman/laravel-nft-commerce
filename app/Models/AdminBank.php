<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminBank extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $fillable = [
        'tab_selection',
        'tab_name',
        'bank_name',
        'account_name',
        'account_number',
        'swift_code',
        'ifsc_code',
        'routing',
        'bank_country',
        'bank_address',
        'minimum_deposit',
        'note'
    ];
}

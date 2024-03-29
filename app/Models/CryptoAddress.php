<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoAddress extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $fillable = [
        'address',
        'name',
        'block_chain',
        'created_by',
        'admin_id',
        'created_ip',
        'browser',
        'country',
        'token',
    ];
}

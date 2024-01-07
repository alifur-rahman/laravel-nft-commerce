<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'id ',
        'user_id ',
        'user_name ',
        'address ',
        'private_key ',
        'details ',
        'created_at ',
        'updated_at '
    ];

}

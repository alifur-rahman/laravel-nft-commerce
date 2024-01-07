<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherTransaction extends Model
{
    use HasFactory;

    /*
    |----------------------------------------------------------------------
    | one to one relation with Withdraw Model
    |----------------------------------------------------------------------
    */
    public function withdraws()
    {
        return $this->hasOne(Withdraw::class);
    }
    public function deposits()
    {
        return $this->hasOne(Deposit::class);
    }
}

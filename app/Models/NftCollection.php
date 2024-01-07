<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftCollection extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'details','item','url','cover_photo','profile_photo'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

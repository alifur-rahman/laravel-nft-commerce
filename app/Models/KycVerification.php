<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KycVerification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'id_number',
        'issue_date',
        'exp_date',
        'doc_type',
        'perpose',
        'document_name',
        'status',
        'note',
        'approved_by',
        'approved_date'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $table = 'company_infos';
    use HasFactory;
    protected $fillable = [
        'com_name',
        'com_logo',
        'com_license',
        'com_email',
        'com_phone',
        'com_website',
        'com_authority',
        'com_address',
        'copyright',
        'support_email',
        'auto_email',
        'com_social_info'
    ];
}

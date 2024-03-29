<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class SystemConfig extends Model
{
    public $timestamps = true;
    use HasFactory, HasRoles, LogsActivity;
    // user activity log---------------------------------------------------
    // package use spatie
    // log the change attributes for all events
    protected static $recordEvents = ['created', 'updated', 'deleted'];

    // Customize log description
    public function getDescriptionForEvent(string $eventName): string
    {
        $ip_address = request()->ip();
        return "The IP address $ip_address has been {$eventName} system config";
    }
    protected $fillable = [
        'id',
        'crm_type',
        'platform_type',
        'server_type',
        'demo_api_key',
        'api_url',
        'live_api_key',
        'server_ip',
        'manager_login',
        'manager_password',
        'api_password',
        'theme',
        'logo',
        'copyright',
        'privacy_statement',
        'support_email',
        'auto_email',
        'platform_download_link',
        'mail_driver',
        'host',
        'port',
        'mail_user',
        'mail_password',
        'mail_encryption',
        'acc_limit',
        'create_meta_acc',
        'platform_book',
        'brute_force_attack',
        'transaction_charge',
        'transaction_permission',
        'com_contact_no',
        'com_name',
        'com_website',
        'com_license',
        'com_email',
        'com_authority',
    ];
    // get activity log option and create log
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])->useLogName('system config');
    }
}

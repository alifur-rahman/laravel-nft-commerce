<?php

namespace App\Services;

use App\Mail\NotificationMail;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;

class MailService
{
    public static function mail($to,$data, $subject, $use_for = null)
    {
        $status = Mail::to($to)->send(new NotificationMail($data, $subject, $use_for));
        return $status;
    }
}

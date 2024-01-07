<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $mail_subject;
    public $use_for;
    public $company_name;
    public $receiver_email;
    public $receiver_name;
    public $support_email;
    public $custom_message;
    public $facebook;
    public $twitter;
    public $instagram;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$subject,$use_for)
    {
        $this->mail_subject = $subject;
        $this->data = $data;
        $this->use_for = $use_for;
        $this->custom_message = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template = EmailTemplate::select('name')->where('use_for',$this->use_for)->first();
        if (isset($template->name)) {
            $template = $template->name;
        }
        else {
            $template = $this->use_for;
        }
        $this->subject($this->mail_subject)->view("email.$template");
        return $this;
    }
}

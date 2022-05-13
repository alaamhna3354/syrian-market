<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreate extends Mailable
{
    use Queueable, SerializesModels;
    public $emailTitle;
    public $mess;
    public $email_notify;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailtemplate, $message)
    {
        $this->emailTitle = $emailtemplate['title'];
        $this->mess = $message;
        $this->email_notify = $emailtemplate['email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from( $this->email_notify,'Mailtrap')->view('admin.pages.email.mailsend')->with('description', $this->mess);
    }
}

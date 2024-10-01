<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;
    // public $email;
    public $subject;
    public $data;
    public $templete;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $data, $templete)
    {
        // $this->email = $email;
        $this->subject = $subject;
        $this->data = $data;
        $this->templete = $templete;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $send_email = $this->from('mail@etherstaging.xyz', 'Ebook')
            ->subject($this->subject)
            ->view($this->templete, ['data' => $this->data]);

        if (isset($this->data['attachment'])) {
            $send_email->attach($this->data['attachment']);
        }
        return $send_email;
    }
}

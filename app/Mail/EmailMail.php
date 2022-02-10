<?php

namespace App\Mail;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Email instance
     *
     * @var Email
     */
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Email $email)
    {
        $this->email = $email;
        $this->subject('Email #' . $email->id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->email->attachments->count() > 0) {
            foreach ($this->email->attachments as $attachment) {
                $this->attachData(base64_decode($attachment->attachment), $attachment->filename);
            }
        }

        //This is not called until the email is being sent
        //I did this to save time, but there is an event listener you can listen to for after emails send
        $this->email->sent = 1;
        $this->email->save();

        return $this->view('emails.email')
            ->with(['email' => $this->email]);
    }
}

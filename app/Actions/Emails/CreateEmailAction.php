<?php

namespace App\Actions\Emails;

use App\Mail\EmailMail;
use App\Models\Email;
use Illuminate\Support\Facades\Mail;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateEmailAction
{
    use AsAction;

    /**
     * Handle Create Email Action
     *
     * @param string|int $sent
     * @return Email
     */
    public function handle(array $emailData, ?array $attachmentData = null): Email
    {
        $email = Email::create($emailData);

        if ($attachmentData) {
            $email->attachments()->create($attachmentData);
        }

        $email->load('attachments');

        //Async sending email
        Mail::to($email->email_address)
            ->queue(new EmailMail($email));

        return $email;
    }
}

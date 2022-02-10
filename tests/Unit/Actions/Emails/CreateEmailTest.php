<?php

namespace Tests\Unit\Actions\Emails;

use App\Actions\Emails\CreateEmailAction;
use App\Mail\EmailMail;
use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CreateEmailTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateEmail()
    {
        $emailData = $this->getEmailData();

        Mail::fake();

        $email = CreateEmailAction::run($emailData['email'], $emailData['attachment']);
        $this->assertInstanceOf(Email::class, $email);

        Mail::assertQueued(EmailMail::class);
    }

    private function getEmailData(): array
    {
        return [
            'email' => [
                'email_address' => $this->faker->email,
                'message' => $this->faker->text,
            ],
            'attachment' => [
                'filename' => 'test.png',
                'attachment' => 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAA1JREFUGFdjePaL7T8AB5YC5qtINZwAAAAASUVORK5CYII=',
            ],
        ];
    }
}

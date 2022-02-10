<?php

namespace Tests\Unit\Actions\Emails;

use App\Actions\Emails\CreateEmailAction;
use App\Actions\Emails\ShowEmailsAction;
use App\Models\Email;
use App\Models\EmailAttachment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetEmailsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->createEmail();
    }

    public function testGetEmails()
    {
        $emails = ShowEmailsAction::run();
        $this->assertCount(1, $emails);
        $email = $emails->first();
        $this->assertInstanceOf(Email::class, $email);
        $this->assertCount(1, $email->attachments);
        $this->assertInstanceOf(EmailAttachment::class, $email->attachments->first());
    }

    private function createEmail(): void
    {
        $data = [
            'email' => [
                'email_address' => $this->faker->email,
                'message' => $this->faker->text,
            ],
            'attachment' => [
                'filename' => 'test.png',
                'attachment' => 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAA1JREFUGFdjePaL7T8AB5YC5qtINZwAAAAASUVORK5CYII=',
            ],
        ];

        CreateEmailAction::run($data['email'], $data['attachment']);
    }
}

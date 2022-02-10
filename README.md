This is built using Laravel Sail

To run simply run `composer install` and then `./vendor/bin/sail up`
Also open a new tab to run queue: `./vendor/bin/sail artisan queue:work`
Open to `http://localhost:8025/#` to view emails sent

Routes are:
    1. localhost/api/email GET
    2. localhost/api/email POST

Emails are saved to the database, and have an initial value of sent of 0 and during sending get sent set to 1.

To keep things simple, I put the setting of sent to 1 inside the mailer class, but there is a event handler that I could have attached to which would be fired after the email was sent.

I kept testing very simple, they should ideally be using factories with faker. Tests should also include feature tests.

Tests can be run using ` ./vendor/bin/sail test`

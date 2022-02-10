<?php

namespace App\Actions\Emails;

use App\Models\Email;
use Illuminate\Database\Eloquent\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowEmailsAction
{
    use AsAction;

    /**
     * Handle Show Emails Action
     *
     * @param string|int $sent
     * @return Collection[Email]
     */
    public function handle($sent = null): Collection
    {
        $emailsQuery = Email::with('attachments');
        if ($sent && in_array($sent, [0, 1])) {
            $emailsQuery->where('sent', $sent);
        }
        return $emailsQuery->get();
    }
}

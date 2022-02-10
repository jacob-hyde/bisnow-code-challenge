<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Email Model
 */
class Email extends Model
{

    protected $table = 'emails';

    protected $fillable = [
        'email_address',
        'message',
        'sent',
    ];

    /**
     * Emails can have many attachemnts
     *
     * @return HasMany[EmailAttachment]
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(EmailAttachment::class);
    }
}

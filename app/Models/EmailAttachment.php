<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Email Attachment Model
 */
class EmailAttachment extends Model
{
    protected $table = 'email_attachments';

    protected $fillable = [
        'email_id',
        'filename',
        'attachment',
    ];

    /**
     * Attachments belong to an email
     *
     * @return BelongsTo[Email]
     */
    public function email(): BelongsTo
    {
        return $this->belongsTo(Email::class);
    }
}

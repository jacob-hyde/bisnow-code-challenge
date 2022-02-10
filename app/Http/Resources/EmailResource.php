<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email_address' => $this->email_address,
            'message' => $this->message,
            'sent' => $this->sent,
            'attachments' => EmailAttachmentResource::collection($this->whenLoaded('attachments')),
        ];
    }
}

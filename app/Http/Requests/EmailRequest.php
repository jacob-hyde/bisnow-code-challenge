<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email_address' => 'required|email',
            'message' => 'required|string',
            'attachment' => ['string', function ($attribute, $val, $fail) {
                //Probably not the safest way to determine the validity of a base64 string
                if (!base64_decode($val)) {
                    return $fail($attribute . ' must be base64 encoded');
                }
            }],
            'attachment_filename' => 'string',
        ];
    }

    public function getEmailData(): array
    {
        return $this->only([
            'email_address',
            'message',
        ]);
    }

    public function getAttachmentData(): ?array
    {
        if ($this->attachment && $this->attachment_filename) {
            $data = $this->only([
                'attachment',
            ]);
            $data['filename'] = $this->attachment_filename;
            return $data;
        }
        return null;
    }
}

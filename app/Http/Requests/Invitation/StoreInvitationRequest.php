<?php

namespace App\Http\Requests\Invitation;

use App\Entities\Invitation\Invitation;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvitationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            Invitation::NAME_COLUMN       => ['required', 'string'],
            Invitation::EMAIL_COLUMN      => ['required', 'string', 'email'],
            Invitation::COMPANY_ID_COLUMN => ['required'],
        ];
    }
}

<?php

namespace App\Http\Requests\Invitation;

use App\Entities\Employee\Employee;
use App\Entities\Invitation\Invitation;
use Illuminate\Foundation\Http\FormRequest;

class SubmitInvitationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            Invitation::TOKEN_COLUMN   => ['required', 'string'],
            Employee::ADDRESS_COLUMN   => ['required', 'string'],
            Employee::PHONE_COLUMN     => ['required'],
            Employee::BIRTHDATE_COLUMN => ['required'],
            Employee::PASSWORD_COLUMN  => ['required', 'min:4'],
        ];
    }
}

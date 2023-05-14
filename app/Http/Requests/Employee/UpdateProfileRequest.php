<?php

namespace App\Http\Requests\Employee;

use App\Entities\Employee\Employee;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            Employee::ADDRESS_COLUMN   => ['nullable', 'string'],
            Employee::PHONE_COLUMN     => ['nullable'],
            Employee::BIRTHDATE_COLUMN => ['nullable', 'string'],
            Employee::NAME_COLUMN      => ['nullable'],
            Employee::PASSWORD_COLUMN  => ['nullable', 'min:4'],
        ];

        // We can add password confirmation, and isolate this password into a separate form.
    }
}

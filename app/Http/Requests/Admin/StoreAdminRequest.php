<?php

namespace App\Http\Requests\Admin;

use App\Entities\Admin\Admin;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            Admin::NAME_COLUMN     => ['required', 'string'],
            Admin::EMAIL_COLUMN    => ['required', 'string', 'email'],
            Admin::PASSWORD_COLUMN => ['required', 'min:6'],
        ];
    }
}

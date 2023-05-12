<?php

namespace App\Http\Requests\Company;

use App\Entities\Company\Company;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            Company::NAME_COLUMN    => ['required', 'string'],
            Company::ADDRESS_COLUMN => ['required', 'string'],
            Company::CAPITAL_COLUMN => [],
        ];
    }
}

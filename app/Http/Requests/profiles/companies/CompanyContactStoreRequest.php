<?php

namespace App\Http\Requests\profiles\companies;

use Illuminate\Foundation\Http\FormRequest;
use MoonShine\Http\Requests\MoonShineFormRequest;

class CompanyContactStoreRequest extends MoonShineFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'unique:company_contacts',
                'string',
                'max:255',
            ],
            'phone' => [
                'required',
                'unique:company_contacts',
                'string',
            ],
            'company_id' => [
                'required',
                'max:255',
            ],
        ];
    }
}

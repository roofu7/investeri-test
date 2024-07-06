<?php

namespace App\Http\Requests\profiles\companies;

use MoonShine\Http\Requests\MoonShineFormRequest;

class CompanyUpdateRequest extends MoonshineFormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'inn' => [
                'required',
                'string',
                'min:10',
                'max:12',
            ],
            'ogrn' => [
                'required',
                'string',
                'min:13',
                'max:15',
            ],
        ];
    }
}

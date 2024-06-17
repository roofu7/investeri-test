<?php

namespace App\Http\Requests\profiles\companies;

use Illuminate\Foundation\Http\FormRequest;
use MoonShine\Http\Requests\MoonShineFormRequest;

class CompanyStoreRequest extends  MoonShineFormRequest
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
                'unique:companies',
                'string',
                'min:10',
                'max:10',
            ],
            'ogrn' => [
                'required',
                'unique:companies',
                'string',
                'min:13',
                'max:13',
            ],
            'user_id' => [
                'required',
                'max:255'
            ],
        ];
    }
}

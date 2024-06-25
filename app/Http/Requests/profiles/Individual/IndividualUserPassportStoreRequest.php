<?php

namespace App\Http\Requests\profiles\Individual;

use Illuminate\Foundation\Http\FormRequest;
use MoonShine\Http\Requests\MoonShineFormRequest;

class IndividualUserPassportStoreRequest extends  MoonShineFormRequest
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
            'serial' => [
                'required',
                'string',
                'max:255',
            ],
            'number' => [
                'required',
                'string',
                'max:12',
            ],
            'issued_whom' => [
                'required',
                'string',
                'max:255',
            ],
            'date_issue' => [
                'required',
                'string',
                'min:10',
                'max:10',
            ],
            'individual_user_id' => [
                'required',
                'max:255'
            ],
        ];
    }
}

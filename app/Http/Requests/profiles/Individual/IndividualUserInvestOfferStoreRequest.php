<?php

namespace App\Http\Requests\profiles\Individual;

use Illuminate\Foundation\Http\FormRequest;
use MoonShine\Http\Requests\MoonShineFormRequest;

class IndividualUserInvestOfferStoreRequest extends MoonShineFormRequest
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
            'basic_information' => [
                'required',
                'string',
                'max:255',
            ],
            'individual_user_id' => [
                'required',
                'max:255'
            ],
        ];
    }
}

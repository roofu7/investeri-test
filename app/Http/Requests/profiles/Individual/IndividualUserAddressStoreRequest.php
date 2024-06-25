<?php

namespace App\Http\Requests\profiles\Individual;

use Illuminate\Foundation\Http\FormRequest;
use MoonShine\Http\Requests\MoonShineFormRequest;

class IndividualUserAddressStoreRequest extends  MoonShineFormRequest
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
            'region' => [
                'required',
                'string',
                'max:255',
            ],
            'city' => [
                'required',
                'string',
                'max:255',
            ],
            'street' => [
                'required',
                'string',
                'max:255',
            ],
            'house_number' => [
                'required',
                'string',
                'max:255',
            ],
            'building_number' => [
                'required',
                'string',
                'max:255',
            ],
            'room_number' => [
                'required',
                'string',
                'max:255',
            ],
            'individual_user_id' => [
                'required',
                'max:255',
            ],
        ];
    }
}

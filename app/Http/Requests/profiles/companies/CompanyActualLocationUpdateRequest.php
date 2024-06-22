<?php

namespace App\Http\Requests\profiles\companies;

use Illuminate\Foundation\Http\FormRequest;
use MoonShine\Http\Requests\MoonShineFormRequest;

class CompanyActualLocationUpdateRequest extends MoonShineFormRequest
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
                'required'
            ],
            'city' => [
                'required'
            ],
            'street' => [
                'required'
            ],
            'house_number' => [
                'required'
            ],
            'building_number' => [
                'required'
            ],
            'room_number' => [
                'required'
            ],
            'company_id' => [
                'required'
            ],
        ];
    }
}

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
                'max:10',
            ],
            'ogrn' => [
                'required',
                'string',
                'min:13',
                'max:13',
            ],


            //CompanyActualLocation
//            'region' => [
//                'required',
//                'string',
//                'max:255',
//            ],
//            'city' => [
//                'required',
//                'string',
//                'max:255',
//            ],
//            'street' => [
//                'required',
//                'string',
//                'max:255',
//            ],
//            'house_number' => [
//                'required',
//                'max:255'
//            ],
//            'building_number' => [
//                'required',
//                'max:255'
//            ],
//            'room_number' => [
//                'required',
//                'max:255'
//            ],

            //CompanyLegalLocation
        ];
    }
}

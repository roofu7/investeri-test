<?php

namespace App\Http\Controllers\profiles\Individual;

use App\Http\Requests\profiles\Individual\IndividualUserPassportStoreRequest;
use App\Models\profiles\Individual\IndividualUserPassport;
use MoonShine\Http\Controllers\MoonShineController;

class IndividualUserPassportController extends MoonShineController
{
    public function store(
        IndividualUserPassport             $individualUserPassport,
        IndividualUserPassportStoreRequest $storeRequest,
    )
    {
        $individualUserPassport
            ->query()
            ->create($storeRequest->validated());
        return $this->json(message: 'Успешно',
            redirect: route('individual.index',
                parameters: ['user' => auth()->user()->getAttribute('name')]));
    }
}

<?php

namespace App\Http\Controllers\profiles\Individual;

use App\Http\Controllers\Controller;
use App\Http\Requests\profiles\Individual\IndividualUserAddressStoreRequest;
use App\Http\Requests\profiles\Individual\IndividualUserAddressUpdateRequest;
use App\Models\profiles\Individual\IndividualUserAddress;
use MoonShine\Http\Controllers\MoonShineController;

class IndividualUserAddressController extends MoonShineController
{
    public function store(
        IndividualUserAddress             $individualUserAddress,
        IndividualUserAddressStoreRequest $storeRequest,
    )
    {
        $individualUserAddress
            ->query()
            ->create($storeRequest->validated());
        return $this->json(
            message: 'Успешно',
            redirect: route('individual.index', parameters: ['user' => auth()->user()->getAttribute('name')]
            ));
    }

    public function update(
        IndividualUserAddress              $individualUserAddress,
        IndividualUserAddressUpdateRequest $updateRequest
    )
    {
        $individualUserAddress
            ->query()
            ->update($updateRequest->validated());
        return $this->json(message: 'Успешно');
    }
}

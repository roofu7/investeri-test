<?php

namespace App\Http\Controllers\profiles\Individual;

use App\Http\Requests\profiles\Individual\IndividualUserContactStoreRequest;
use App\Http\Requests\profiles\Individual\IndividualUserContactUpdateRequest;
use App\Models\profiles\Individual\IndividualUserContact;
use MoonShine\Http\Controllers\MoonShineController;

class IndividualUserContactController extends MoonShineController
{
    public function store(
        IndividualUserContact             $individualUserContact,
        IndividualUserContactStoreRequest $storeRequest,
    )
    {
        $individualUserContact
            ->query()
            ->create($storeRequest->validated());
        return $this->json(message: 'Успешно');
    }
    public function update(
        IndividualUserContact             $individualUserContact,
        IndividualUserContactUpdateRequest $updateRequest
    )
    {
        $individualUserContact
            ->query()
            ->update($updateRequest->validated());
        return $this->json(message: 'Успешно');
    }
}

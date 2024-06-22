<?php

namespace App\Http\Controllers\profiles\companies;

use App\Http\Requests\profiles\companies\CompanyContactStoreRequest;
use App\Http\Requests\profiles\companies\CompanyContactUpdateRequest;
use App\Models\profiles\companies\CompanyContact;
use MoonShine\Http\Controllers\MoonShineController;

class CompanyContactController extends MoonShineController
{
    public function store(
        CompanyContact             $companyContact,
        CompanyContactStoreRequest $request,
    )
    {
        $companyContact
            ->query()
            ->create($request->validated());
        return $this->json(message: 'Успешно');
    }

    public function update(
        CompanyContact              $companyContact,
        CompanyContactUpdateRequest $request,
                                    $id,
    )
    {
        $companyContact->query()
            ->where('id', $id)
            ->update($request->validated());
        return $this->json(message: 'Успешно');
    }
}

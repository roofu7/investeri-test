<?php

namespace App\Http\Controllers\profiles\companies;

use App\Http\Requests\profiles\companies\CompanyActualLocationStoreRequest;
use App\Models\profiles\companies\CompanyActualLocation;
use MoonShine\Http\Controllers\MoonShineController;

class CompanyActualLocationController extends MoonShineController
{
    public function store(
        CompanyActualLocation             $companyActualLocation,
        CompanyActualLocationStoreRequest $request
    )
    {
        $companyActualLocation
            ->query()
            ->create($request->validated());
        return $this->json(message: 'Успешно');
    }

    public function update(
        CompanyActualLocation             $companyActualLocation,
        CompanyActualLocationStoreRequest $request
    )
    {
        $companyActualLocation
            ->query()
            ->update($request->validated());
        return $this->json(message: 'Успешно');
    }
}

<?php

namespace App\Http\Controllers\profiles\investProjects;

use App\Http\Requests\profiles\companies\CompanyStoreRequest;
use App\Http\Requests\profiles\companies\CompanyUpdateRequest;
use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyActualLocation;
use App\Models\profiles\companies\CompanyContact;
use App\Models\profiles\companies\CompanyLegalLocation;
use App\Pages\profiles\companies\CompanyForm;
use App\Pages\profiles\companies\CompanyIndex;
use App\Pages\profiles\companies\CompanyProfileForm;
use Illuminate\Http\Request;
use MoonShine\Http\Controllers\MoonShineController;

class InvestProjectController extends MoonShineController
{
    public function index(): CompanyIndex
    {
        return CompanyIndex::make();
    }

    public function create(): CompanyForm
    {
        return CompanyForm::make();
    }

    public function store(CompanyStoreRequest $storeRequest)
    {
//        dd($storeRequest);
//        $id = Auth::id();
//        $merge = $storeRequest->merge(['user_id' => $id]);
//        $validated = $merge->validated();
//        dd($storeRequest);
//        parameters: ['id' => $company->getKey()])

        Company::query()->create($storeRequest->validated());

        return $this->json('Добавлено', redirect: route('company.index', parameters: ['user' => auth()->user()->getAttribute('name')]));
    }

    public function edit(): CompanyProfileForm

    {
        return CompanyProfileForm::make();
    }

    public function update(
        Company              $company,
        CompanyUpdateRequest $updateRequest,
                             $id
    )
    {
        $company->query()
            ->where('id', $id)
            ->update($updateRequest->validated());
        return $this->json(message: 'Успешно');
    }

    public function delete(Company $company, $user, $id)
    {
        $company->query()
            ->where('id', $id)
            ->delete();
        return $this->json(message: 'Успешно');
    }
}

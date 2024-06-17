<?php

namespace App\Http\Controllers\profiles\companies;

use App\Http\Requests\profiles\companies\CompanyStoreRequest;
use App\Http\Requests\profiles\companies\CompanyUpdateRequest;
use App\Models\profiles\companies\Company;
use App\Models\User;
use App\Pages\profiles\companies\CompanyForm;
use App\Pages\profiles\companies\CompanyIndex;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MoonShine\Http\Controllers\MoonShineController;

class CompanyController extends MoonShineController
{
    public function index(Request $request): CompanyIndex
    {
        return CompanyIndex::make();
    }

    public function create(Request $request): CompanyForm
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
        $company = Company::query()
        ->create($storeRequest->validated());

        return $this->json('Добавлено', redirect: route('company.index', parameters: ['id' => $company->getKey()]));
    }

    public function update(Company $company, CompanyUpdateRequest $request)
    {
        $company->update($request->validated());
        return $this->json(message: 'Успешно');
    }

    public function delete(Company $company)
    {
        $company->delete();
        return $this->json(message: 'Удалено');
    }
}

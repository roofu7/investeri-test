<?php

namespace App\Http\Controllers\profiles\investProjects;

use App\Http\Requests\profiles\companies\CompanyStoreRequest;
use App\Http\Requests\profiles\companies\CompanyUpdateRequest;
use App\Http\Requests\profiles\InvestProjects\CompanyInvestProjectStoreRequest;
use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyActualLocation;
use App\Models\profiles\companies\CompanyContact;
use App\Models\profiles\companies\CompanyInvestProject;
use App\Models\profiles\companies\CompanyLegalLocation;
use App\Pages\profiles\companies\CompanyForm;
use App\Pages\profiles\companies\CompanyIndex;
use App\Pages\profiles\companies\CompanyProfileForm;
use App\Pages\profiles\investProject\InvestProjectForm;
use App\Pages\profiles\investProject\InvestProjectIndex;
use Illuminate\Http\Request;
use MoonShine\Http\Controllers\MoonShineController;

class InvestProjectController extends MoonShineController
{
    public function index(): InvestProjectIndex
    {
        return InvestProjectIndex::make();
    }

    public function create(): InvestProjectForm
    {
        return InvestProjectForm::make();
    }

    public function store(
        CompanyInvestProjectStoreRequest $storeRequest
    )
    {
        CompanyInvestProject::query()
            ->create($storeRequest->validated());
        return $this->json('Добавлено',
            redirect: route('company.invest.projects.index',
                parameters: [
                    'user' => auth()
                        ->user()
                        ->getAttribute('name')
                ]));
    }

    /*public function edit(): CompanyProfileForm

    {
        return CompanyProfileForm::make();
    }*/

    public function update(
        CompanyInvestProject                          $companyInvestProject,
        CompanyInvestProjectStoreRequest $updateRequest,
                                         $id
    )
    {
        $companyInvestProject->query()
            ->where('id', $id)
            ->update($updateRequest->validated());
        return $this->json(message: 'Успешно');
    }

    public function delete(CompanyInvestProject $companyInvestProject, $user, $id)
    {
        $companyInvestProject->query()
            ->where('id', $id)
            ->delete();
        return $this->json(message: 'Успешно');
    }
}

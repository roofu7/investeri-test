<?php

namespace App\Http\Controllers\profiles\companies;

use App\Http\Requests\profiles\InvestProjects\CompanyInvestProjectStoreRequest;
use App\Models\profiles\companies\CompanyInvestProject;
use App\Pages\profiles\companies\CompanyInvestProjectIndex;
use App\Pages\profiles\investProject\InvestProjectForm;
use MoonShine\Http\Controllers\MoonShineController;

class CompanyInvestProjectController extends MoonShineController
{
    public function index(): CompanyInvestProjectIndex
    {
        return CompanyInvestProjectIndex::make();
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
        CompanyInvestProject             $companyInvestProject,
        CompanyInvestProjectStoreRequest $updateRequest,
                                         $id
    )
    {
        $companyInvestProject->query()
            ->where('id', $id)
            ->update($updateRequest->validated());
        return $this->json(message: 'Успешно');
    }

    public function delete(
        CompanyInvestProject $companyInvestProject,
                             $user,
                             $id
    )
    {
        $companyInvestProject->query()
            ->where('id', $id)
            ->delete();
        return $this->json(
            message: 'Успешно',
            redirect: route(
                'company.invest.projects.index',
                parameters: [
                    'user' => auth()
                        ->user()
                        ->getAttribute('name')
                ]
            )
        );
    }
}

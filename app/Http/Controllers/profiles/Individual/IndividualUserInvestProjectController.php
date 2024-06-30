<?php

namespace App\Http\Controllers\profiles\Individual;

use App\Http\Requests\profiles\Individual\IndividualUserInvestProjectStoreRequest;
use App\Http\Requests\profiles\Individual\IndividualUserInvestProjectUpdateRequest;
use App\Models\profiles\Individual\IndividualUserInvestProject;
use App\Pages\profiles\Individual\IndividualUserInvestProjectIndex;
use MoonShine\Http\Controllers\MoonShineController;

class IndividualUserInvestProjectController extends MoonShineController
{
    public function index(): IndividualUserInvestProjectIndex
    {
        return IndividualUserInvestProjectIndex::make();
    }

//    public function create(): InvestProjectForm
//    {
//        return InvestProjectForm::make();
//    }

    public function store(
        IndividualUserInvestProjectStoreRequest $storeRequest
    )
    {
        IndividualUserInvestProject::query()
            ->create($storeRequest->validated());
        return $this->json('Добавлено',
            redirect: route(
                'individual.invest.projects.index',
                parameters: [
                    'user' => auth()
                        ->user()
                        ->getAttribute('name')
                ]
            )
        );
    }

    public function update(
        IndividualUserInvestProject              $individualUserInvestProject,
        IndividualUserInvestProjectUpdateRequest $updateRequest,
                                                 $id
    )
    {
        $individualUserInvestProject->query()
            ->where('id', $id)
            ->update($updateRequest->validated());
        return $this->json(message: 'Успешно');
    }

    public function delete(
        IndividualUserInvestProject $individualUserInvestProject,
                                    $user,
                                    $id
    )
    {
        $individualUserInvestProject->query()
            ->where('id', $id)
            ->delete();
        return $this->json(message: 'Успешно',
            redirect: route(
                'individual.invest.projects.index',
                parameters: [
                    'user' => auth()
                        ->user()
                        ->getAttribute('name')
                ]
            )
        );
    }
}

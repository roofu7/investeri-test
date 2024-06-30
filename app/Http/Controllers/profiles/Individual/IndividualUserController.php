<?php

namespace App\Http\Controllers\profiles\Individual;

use App\Http\Requests\profiles\Individual\IndividualUserStoreRequest;
use App\Http\Requests\profiles\Individual\IndividualUserUpdateRequest;
use App\Models\profiles\Individual\IndividualUser;
use App\Pages\profiles\Individual\IndividualUserCreate;
use App\Pages\profiles\Individual\IndividualUserIndex;
use MoonShine\Http\Controllers\MoonShineController;

class IndividualUserController extends MoonShineController
{
    public function index(): IndividualUserIndex
    {
        return IndividualUserIndex::make();
    }

    public function create(): IndividualUserCreate
    {
        return IndividualUserCreate::make();
    }

    public function store(
        IndividualUserStoreRequest $storeRequest
    )
    {
        IndividualUser::query()
            ->create($storeRequest->validated());
        return $this->json('Добавлено',
            redirect: route('individual.create',
                parameters: ['user' => auth()->user()->getAttribute('name')]));
    }

    public function update(
        IndividualUser              $individualUser,
        IndividualUserUpdateRequest $updateRequest,
                                    $id
    )
    {
        $individualUser->query()
            ->where('id', $id)
            ->update($updateRequest->validated());
        return $this->json(message: 'Успешно');
    }

    public function delete(
        IndividualUser $individualUser,
                       $user,
                       $id
    )
    {
        $individualUser->query()
            ->where('id', $id)
            ->delete();
        return $this->json(
            message: 'Успешно',
            redirect: route(
                'individual.index',
                parameters: [
                    'user' => auth()->user()->getAttribute('name')
                ]
            )
        );
    }
}

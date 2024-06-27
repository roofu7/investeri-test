<?php

namespace App\Http\Controllers\profiles\Individual;

use App\Http\Requests\profiles\companies\IndividualUserInvestOfferUpdateRequest;
use App\Http\Requests\profiles\Individual\IndividualUserInvestOfferStoreRequest;
use App\Models\profiles\Individual\IndividualUserInvestOffer;
use App\Pages\profiles\Individual\IndividualUserInvestOfferIndex;
use MoonShine\Http\Controllers\MoonShineController;

class IndividualUserInvestOfferController extends MoonShineController
{
    public function index(): IndividualUserInvestOfferIndex
    {
        return IndividualUserInvestOfferIndex::make();
    }

//    public function create(): InvestProjectForm
//    {
//        return InvestProjectForm::make();
//    }

    public function store(
        IndividualUserInvestOfferStoreRequest $storeRequest
    )
    {
        IndividualUserInvestOffer::query()
            ->create($storeRequest->validated());
        return $this->json('Добавлено');
    }

//    public function edit(): CompanyProfileForm
//
//    {
//        return CompanyProfileForm::make();
//    }

    public function update(
        IndividualUserInvestOffer              $individualUserInvestOffer,
        IndividualUserInvestOfferUpdateRequest $updateRequest,
                                               $id
    )
    {
        $individualUserInvestOffer->query()
            ->where('id', $id)
            ->update($updateRequest->validated());
        return $this->json(message: 'Успешно');
    }

    public function delete(
        IndividualUserInvestOffer $individualUserInvestOffer,
                                  $user,
                                  $id
    )
    {
        $individualUserInvestOffer->query()
            ->where('id', $id)
            ->delete();
        return $this->json(message: 'Успешно');
    }
}

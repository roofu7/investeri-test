<?php

namespace App\Http\Controllers\profiles\companies;

use App\Http\Requests\profiles\companies\CompanyInvestOfferStoreRequest;
use App\Models\profiles\companies\CompanyInvestOffer;
use App\Pages\profiles\companies\CompanyInvestOfferIndex;
use MoonShine\Http\Controllers\MoonShineController;

class CompanyInvestOfferController extends MoonShineController
{
    public function index(): CompanyInvestOfferIndex
    {
        return CompanyInvestOfferIndex::make();
    }

    public function store(
        CompanyInvestOfferStoreRequest $storeRequest
    )
    {
        CompanyInvestOffer::query()
            ->create($storeRequest->validated());
        return $this->json('Добавлено',
            redirect: route('company.invest.offers.index',
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
        CompanyInvestOffer             $companyInvestOffer,
        CompanyInvestOfferStoreRequest $updateRequest,
                                       $id
    )
    {
        $companyInvestOffer->query()
            ->where('id', $id)
            ->update($updateRequest->validated());
        return $this->json(message: 'Успешно');
    }

    public function delete(
        CompanyInvestOffer $companyInvestOffer,
                           $user,
                           $id
    )
    {
        $companyInvestOffer->query()
            ->where('id', $id)
            ->delete();
        return $this->json(
            message: 'Успешно',
            redirect: route(
                'company.invest.offers.index',
                parameters: [
                    'user' => auth()
                        ->user()
                        ->getAttribute('name')
                ]
            ));
    }
}

<?php

namespace App\Http\Controllers\profiles\companies;

use App\Pages\profiles\companies\CompanyInvestOfferDetails;
use App\Pages\profiles\companies\CompanyInvestProjectDetails;
use MoonShine\Http\Controllers\MoonShineController;

class CompanyInvestOfferDetailsController extends MoonShineController
{
    public function index(): CompanyInvestOfferDetails
    {
        return CompanyInvestOfferDetails::make();
    }
}

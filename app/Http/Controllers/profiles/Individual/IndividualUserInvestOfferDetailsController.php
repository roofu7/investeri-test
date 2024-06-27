<?php

namespace App\Http\Controllers\profiles\Individual;

use App\Pages\profiles\companies\CompanyInvestProjectDetails;
use App\Pages\profiles\Individual\IndividualUserInvestOfferDetails;
use App\Pages\profiles\Individual\IndividualUserInvestProjectDetails;
use MoonShine\Http\Controllers\MoonShineController;

class IndividualUserInvestOfferDetailsController extends MoonShineController
{
    public function index(): IndividualUserInvestOfferDetails
    {
        return IndividualUserInvestOfferDetails::make();
    }
}

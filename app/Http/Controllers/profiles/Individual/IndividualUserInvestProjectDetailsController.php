<?php

namespace App\Http\Controllers\profiles\Individual;

use App\Pages\profiles\companies\CompanyInvestProjectDetails;
use App\Pages\profiles\Individual\IndividualUserInvestProjectDetails;
use MoonShine\Http\Controllers\MoonShineController;

class IndividualUserInvestProjectDetailsController extends MoonShineController
{
    public function index(): IndividualUserInvestProjectDetails
    {
        return IndividualUserInvestProjectDetails::make();
    }
}

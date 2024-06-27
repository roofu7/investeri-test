<?php

namespace App\Http\Controllers\profiles\companies;

use App\Pages\profiles\companies\CompanyInvestProjectDetails;
use MoonShine\Http\Controllers\MoonShineController;

class CompanyInvestProjectDetailsController extends MoonShineController
{
    public function index(): CompanyInvestProjectDetails
    {
        return CompanyInvestProjectDetails::make();
    }
}

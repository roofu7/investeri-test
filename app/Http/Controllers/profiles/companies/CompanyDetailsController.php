<?php

namespace App\Http\Controllers\profiles\companies;

use App\Http\Controllers\Controller;
use App\Pages\profiles\companies\CompanyDetails;
use MoonShine\Http\Controllers\MoonShineController;

class CompanyDetailsController extends MoonShineController
{
    public function index(): CompanyDetails
    {
        return new CompanyDetails();
    }
}

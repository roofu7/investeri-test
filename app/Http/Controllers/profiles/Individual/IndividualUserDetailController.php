<?php

namespace App\Http\Controllers\profiles\Individual;

use App\Pages\profiles\Individual\IndividualUserDetails;
use MoonShine\Http\Controllers\MoonShineController;

class IndividualUserDetailController extends MoonShineController
{
    public function index(): IndividualUserDetails
    {
        return IndividualUserDetails::make();
    }
}

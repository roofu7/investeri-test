<?php

namespace App\Http\Controllers;

use App\Models\profiles\companies\Company;

class CardProjectController extends Controller
{
    public function getCompany()
    {
        $company = Company::all();
        return view('main', compact('company'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Pages\profiles\CompanyIndex;
use Illuminate\Http\Request;
use MoonShine\Pages\Page;

class CompanyController extends Controller
{
    public function __invoke(Request $request): CompanyIndex
    {
//        $users = User::find(8);
//        dump($users->companyContacts);
        return CompanyIndex::make();
    }

}

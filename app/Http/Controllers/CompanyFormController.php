<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Pages\profiles\CompanyForm;
use App\Pages\profiles\CompanyIndex;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyFormController extends Controller
{
    public function __invoke(Request $request): CompanyForm
    {
//        $users = User::find(8);
//        dump($users->companyContacts);
        return CompanyForm::make();
    }

    public function store(Request $request): RedirectResponse
    {
        $id = Auth::id();

        $validated = $request->validate([
            'name' => 'required',
            'inn' => 'required|unique:companies|max:255',
            'ogrn' => 'required|unique:companies|max:255',
        ]);

        $collect = collect($validated);
        $merge = $collect->merge(['user_id' => $id]);

        Company::create($merge->toArray());

        return redirect('profile/company');
    }
}

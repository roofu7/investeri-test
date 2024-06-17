<?php

namespace App\Http\Controllers\profiles\companies;

use App\Http\Controllers\Controller;
use App\Models\profiles\companies\Company;
use App\Pages\profiles\companies\CompanyForm;
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
//        dd($request);
//        $user = $request->user();
        $id = Auth::id();
        $validated = $request->validate([
//            '_token' => 'required|max:255',
            'name' => 'required|max:255',
            'inn' => 'required|unique:companies|max:255',
            'ogrn' => 'required|unique:companies|max:255',
        ]);
//        dd($validated);
        $collect = collect($validated);
        $merge = $collect->merge(['user_id' => $id]);

        Company::create($merge->toArray());

        return redirect(route('companyprofile'));
    }
}

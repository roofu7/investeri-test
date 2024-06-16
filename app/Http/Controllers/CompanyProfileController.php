<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyContact;
use App\Models\User;
use App\Pages\profiles\CompanyProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        return CompanyProfile::make();
    }

    public function store(Request $request): RedirectResponse
    {
        dd($request);
//        $user = $request->user();
//        $id = Auth::id();
//        $users = User::find($id)->companyContacts;
        $validated = $request->validate([
            'company_id' => 'required|max:255',
            'email' => 'required|unique:company_contacts|max:255',
            'phone' => 'required|unique:company_contacts|max:255',
        ]);
//        dd($validated);

//        $collect = collect($validated);
//        $merge = $collect->merge(['user_id' => $id]);

        CompanyContact::create($validated);

        return redirect('profile/company');
    }
}

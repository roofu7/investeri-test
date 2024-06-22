<?php

namespace App\Http\Controllers\profiles\companies;

use App\Http\Controllers\Controller;
use App\Models\profiles\companies\CompanyContact;
use App\Pages\profiles\companies\CompanyProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function edit(Request $request)
    {
        return CompanyProfile::make();
    }

    public function store(Request $request): RedirectResponse
    {
//        dd($request);
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

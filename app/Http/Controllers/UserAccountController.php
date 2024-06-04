<?php

namespace App\Http\Controllers;

use App\MoonShine\Pages\Users\UserAccount;
use App\Pages\UserProfilePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MoonShine\Pages\Page;

class UserAccountController extends Controller
{
    public function __invoke(Request $request): UserProfilePage
    {
        return UserProfilePage::make();
    }
}

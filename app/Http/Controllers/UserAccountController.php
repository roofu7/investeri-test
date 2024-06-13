<?php

namespace App\Http\Controllers;

use App\Layouts\ProfileUser;
use App\Models\User;
use App\MoonShine\Pages\Users\UserAccount;
use App\Pages\UserProfilePage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelIdea\Helper\App\Models\_IH_Page_C;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\TableBuilder;
use MoonShine\Fields\Fields;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;

class UserAccountController extends Controller
{
    public function __invoke(Request $request): UserProfilePage
    {
//        $users = User::find(8);
//        dump($users->companyContacts);
        return UserProfilePage::make();
    }

//    public function url(): string
//    {
//        return 'logout';
//    }
//
//    public function isActive(): bool
//    {
//        return true;
//    }
}

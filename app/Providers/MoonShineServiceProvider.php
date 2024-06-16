<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserAccountController;
use App\MoonShine\Resources\CompanyActualLocationResource;
use App\MoonShine\Resources\CompanyContactResource;
use App\MoonShine\Resources\PageResource;
use App\MoonShine\Resources\UserCompanyResource;
use App\MoonShine\Resources\UserProfileResource;
use App\Pages\profiles\CompanyForm;
use App\Pages\profiles\CompanyIndex;
use App\Pages\profiles\CompanyProfile;
use App\Pages\UserProfilePage;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [
            new UserProfileResource(),
            new CompanyContactResource(),
            new UserCompanyResource(),
            new CompanyActualLocationResource()
        ];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [
            new UserProfilePage(),
            new CompanyIndex(),
            new CompanyForm(),
            new CompanyProfile(),
        ];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.admins_title'),
                    new MoonShineUserResource()
                ),
                MenuItem::make(
                    static fn() => __('moonshine::ui.resource.role_title'),
                    new MoonShineUserRoleResource()
                ),
            ])->canSee(fn() => request()->routeIs('moonshine.*')),

            MenuGroup::make('Страницы', [
                MenuItem::make('Создать страницу', new PageResource()),
            ])->canSee(fn() => request()->routeIs('moonshine.*')),

            MenuGroup::make('Project', [
                MenuItem::make('Создать project', fn() => route('home')),
            ])->canSee(fn() => !request()->routeIs('moonshine.*')),

//            MenuGroup::make('Test', [
//                MenuItem::make('Создать test', new UserAccountController()),
//            ])->canSee(fn() => !request()->routeIs('moonshine.*')),

            MenuGroup::make('Юрлицо', [
                MenuItem::make('Компания', fn() => route('companyinfo')),
            ])->canSee(fn() => !request()->routeIs('moonshine.*')),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}

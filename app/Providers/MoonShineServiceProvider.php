<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\profiles\companies\CompanyInvestProject;
use App\MoonShine\Resources\CompanyActualLocationResource;
use App\MoonShine\Resources\CompanyContactResource;
use App\MoonShine\Resources\CompanyInvestProjectResource;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\PageResource;
use App\MoonShine\Resources\UserCompanyResource;
use App\MoonShine\Resources\UserProfileResource;
use App\Pages\profiles\companies\CompanyDetails;
use App\Pages\profiles\companies\CompanyForm;
use App\Pages\profiles\companies\CompanyIndex;
use App\Pages\profiles\companies\CompanyProfile;
use App\Pages\profiles\companies\CompanyProfileForm;
use App\Pages\profiles\companies\MultiForm;
use App\Pages\profiles\investProject\InvestProjectForm;
use App\Pages\profiles\investProject\InvestProjectIndex;
use App\Pages\UserProfilePage;
use Closure;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Pages\Page;
use MoonShine\Providers\MoonShineApplicationServiceProvider;

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
            new CompanyActualLocationResource(),
            new CompanyInvestProjectResource()
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
            new CompanyProfileForm(),
            new CompanyDetails(),
            new CompanyProfile(),
            new MultiForm(),
            new InvestProjectIndex(),
            new InvestProjectForm(),
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

//            MenuGroup::make('Project', [
//                MenuItem::make('Создать project', static fn() => route('home')),
//            ])->canSee(fn() => !request()->routeIs('moonshine.*')),

//            MenuGroup::make('Test', [
//                MenuItem::make('Создать test', new UserAccountController()),
//            ])->canSee(fn() => !request()->routeIs('moonshine.*')),

            MenuGroup::make('Юрлицо', [
                MenuItem::make('Компания', fn () => route('company.index', parameters: auth()->user()->getAttribute('name'))),
                MenuItem::make('Инвестиционные проекты', fn () => route('invest.projects.index', parameters: [auth()->user()->getAttribute('name')])),
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

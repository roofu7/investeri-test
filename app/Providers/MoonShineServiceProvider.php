<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\CompanyActualLocationResource;
use App\MoonShine\Resources\CompanyContactResource;
use App\MoonShine\Resources\CompanyInvestOfferResource;
use App\MoonShine\Resources\CompanyInvestProjectResource;
use App\MoonShine\Resources\IndividualUserInvestOfferResource;
use App\MoonShine\Resources\IndividualUserInvestProjectResource;
use App\MoonShine\Resources\IndividualUserResource;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\PageResource;
use App\MoonShine\Resources\UserCompanyResource;
use App\MoonShine\Resources\UserProfileResource;
use App\Pages\profiles\companies\CompanyDetails;
use App\Pages\profiles\companies\CompanyForm;
use App\Pages\profiles\companies\CompanyIndex;
use App\Pages\profiles\companies\CompanyInvestOfferDetails;
use App\Pages\profiles\companies\CompanyInvestOfferIndex;
use App\Pages\profiles\companies\CompanyInvestProjectIndex;
use App\Pages\profiles\companies\CompanyProfile;
use App\Pages\profiles\companies\CompanyProfileForm;
use App\Pages\profiles\companies\MultiForm;
use App\Pages\profiles\Individual\IndividualUserCreate;
use App\Pages\profiles\Individual\IndividualUserDetails;
use App\Pages\profiles\Individual\IndividualUserIndex;
use App\Pages\profiles\Individual\IndividualUserInvestOfferDetails;
use App\Pages\profiles\Individual\IndividualUserInvestOfferIndex;
use App\Pages\profiles\Individual\IndividualUserInvestProjectDetails;
use App\Pages\profiles\Individual\IndividualUserInvestProjectIndex;
use App\Pages\profiles\investProject\InvestProjectForm;
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
            new CompanyInvestProjectResource(),
            new CompanyInvestOfferResource(),
            new IndividualUserInvestOfferResource(),
            new IndividualUserInvestProjectResource(),
            new IndividualUserResource(),

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
            new CompanyInvestOfferIndex(),
            new CompanyInvestOfferDetails(),
            new MultiForm(),
            new CompanyInvestProjectIndex(),
            new InvestProjectForm(),
            new IndividualUserIndex(),
            new IndividualUserCreate(),
            new IndividualUserDetails(),
            new IndividualUserInvestProjectIndex(),
            new IndividualUserInvestOfferIndex(),
            new IndividualUserInvestOfferDetails(),
            new IndividualUserInvestProjectDetails(),
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

            MenuGroup::make('Юрлицо', [
                MenuItem::make('Компании', fn () => route(
                    'company.index',
                    parameters: auth()->user()->getAttribute('name'))),
                MenuItem::make('Инвестиционные проекты', fn () => route(
                    'company.invest.projects.index',
                    parameters: auth()->user()->getAttribute('name'))),
                MenuItem::make('Инвестиционные предложения', fn () => route(
                    'company.invest.offers.index',
                    parameters: auth()->user()->getAttribute('name'))),
            ])->canSee(fn() => !request()->routeIs('moonshine.*')),

            MenuGroup::make('Физлицо', [
                MenuItem::make('Профиль', fn () => route(
                    'individual.index',
                    parameters: auth()->user()->getAttribute('name'))),
                MenuItem::make('Инвестиционнй проект', fn () => route(
                    'individual.invest.projects.index',
                    parameters: auth()->user()->getAttribute('name'))),
                MenuItem::make('Инвестиционное предложение', fn () => route(
                    'individual.invest.offers.index',
                    parameters: auth()->user()->getAttribute('name'))),
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

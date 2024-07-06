<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Users;

use App\Models\User;
use App\MoonShine\Resources\CompanyInvestOfferResource;
use App\MoonShine\Resources\CompanyInvestProjectResource;
use App\MoonShine\Resources\UserCompanyResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelIdea\Helper\App\Models\_IH_User_C;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Components\TableBuilder;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Relationships\HasManyThrough;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

class UsersList extends Page
{
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'UsersList';
    }

    public function users(): LengthAwarePaginator|array|\Illuminate\Pagination\LengthAwarePaginator|_IH_User_C
    {
        return User::query()->paginate();
    }

    public function fields(): array
    {
        return [
            ID::make(),
            Text::make('Имя', 'name'),
            HasMany::make(
                'Компания',
                'companyForm',
                resource: new UserCompanyResource())
                ->fields([
                    Text::make('Название Компании', 'name')
                ]),
            HasManyThrough::make(
                'Инвестиционный проект',
                'companyInvestProjects',
                resource: new CompanyInvestProjectResource())
                ->fields([
                    Text::make('Название проекта', 'name')
                ]),
            HasManyThrough::make(
                'Инвестиционное предложение',
                'companyInvestOffers',
                resource: new CompanyInvestOfferResource())
                ->fields([
                    Text::make('Название проекта', 'name')
                ]),
        ];
    }

    /**
     * @return MoonShineComponent
     */
    public function components(): array
    {
        return [
            TableBuilder::make()
                ->items($this->users())
                ->fields($this->fields())
                ->cast(ModelCast::make(User::class))
        ];
    }
}

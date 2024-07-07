<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Users;

use App\Models\User;
use App\MoonShine\Resources\CompanyInvestOfferResource;
use App\MoonShine\Resources\CompanyInvestProjectResource;
use App\MoonShine\Resources\UserCompanyResource;
use MoonShine\Components\Badge;
use MoonShine\Components\Card;
use MoonShine\Components\CardsBuilder;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Relationships\HasManyThrough;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

class UserDetails extends Page
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
        return $this->title ?: 'UserDetails';
    }

    public function requestId(): bool
    {
        return request()->filled('id');
    }

    public function userDetails()
    {
        return User::find(request());
    }

    public function fieldsUser(): array
    {
        return [
            ID::make(),
            Text::make('Имя', 'name'),
            Text::make('Почта', 'email'),
            Text::make('Дата регистрации', 'created_at')
        ];
    }

    public function fieldsCompany(): array
    {
        return [
            HasMany::make(
                'Название',
                'companyForm',
                resource: new UserCompanyResource())
                ->fields([
                    Text::make('', 'name'),
                ]),
            HasMany::make(
                'ИНН',
                'companyForm',
                resource: new UserCompanyResource())
                ->fields([
                    Text::make('', 'inn'),
                ]),
            HasMany::make(
                'ОГРН',
                'companyForm',
                resource: new UserCompanyResource())
                ->fields([
                    Text::make('', 'ogrn'),
//                    Text::make('Дата создания', 'created_at')
                ]),
            HasMany::make(
                'Дата создания',
                'companyForm',
                resource: new UserCompanyResource())
                ->fields([
                    Text::make('', 'created_at')
                ]),
        ];
    }

    /*public function fields(): array
    {
        return [
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
    }*/

    /**
     * @return MoonShineComponent
     */
    public function components(): array
    {
        return [
            TableBuilder::make()
                ->items($this->userDetails())
                ->fields($this->fieldsUser())
                ->cast(ModelCast::make(User::class)),

            Block::make('Компании', [
                CardsBuilder::make()
                    ->columnSpan(6)
                    ->items($this->userDetails())
                    ->fields($this->fieldsCompany())
                    ->cast(ModelCast::make(User::class))
                    ->header(static fn() => Badge::make('new', 'success'))
                    ->title('title')
            ]),
        ];
    }
}

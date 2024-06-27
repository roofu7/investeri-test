<?php

declare(strict_types=1);

namespace App\Pages\profiles\companies;

use App\Models\profiles\companies\CompanyInvestOffer;
use App\Models\profiles\companies\CompanyInvestProject;
use App\Models\User;
use App\MoonShine\Resources\CompanyInvestProjectResource;
use App\MoonShine\Resources\UserCompanyResource;
use Illuminate\Database\Eloquent\Collection;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\TableBuilder;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasManyThrough;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

//use MoonShine\Pages\Pages;

class CompanyInvestOfferIndex extends Page
{
    protected string $layout = 'userprofile';

    public function title(): string
    {
        return $this->title ?: 'CompanyInvestOfferIndex';
    }


    public function itemsCompany(): Collection
    {
        return User::find(auth()->id())->companyInvestOffers;
    }

    public function itemsCompanyInvestProject()
    {
        return CompanyInvestOffer::all()->where('company_id', $this->itemsCompany());
    }

    public function fields(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Название', 'name')->showOnExport(),
            Text::make('Краткая информация', 'basic_information')->showOnExport(),
            BelongsTo::make(
                'Компания',
                'company',
                resource: new UserCompanyResource())
        ];
    }

    /**
     * @inheritDoc
     */
    public function components(): array
    {
        return [
            TableBuilder::make()
                ->items($this->itemsCompany())
                ->fields($this->fields())
                ->cast(ModelCast::make(CompanyInvestOffer::class))
                ->buttons([


                    actionbutton::make('', fn(CompanyInvestOffer $companyInvestOffer) => route
                    (
                        'company.invest.offers.details.index',
                        [
                            'user' => auth()->user()->getattribute('name'),
                            'id' => $companyInvestOffer->getkey(),
                        ]
                    )
                    )
                        ->icon('heroicons.outline.eye'),

                    actionbutton::make('', fn(CompanyInvestOffer $companyInvestOffer) => route(
                        'company.invest.offers.delete', [
                        'user' => auth()->user()->getattribute('name'),
                        'id' => $companyInvestOffer->getkey()])
                    )
                        ->async(method: 'delete')
                        ->error()
                        ->icon('heroicons.outline.trash'),
                ]),
        ];
    }
}

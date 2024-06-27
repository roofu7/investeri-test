<?php

declare(strict_types=1);

namespace App\Pages\profiles\Individual;

use App\Models\profiles\companies\CompanyInvestOffer;
use App\Models\profiles\companies\CompanyInvestProject;
use App\Models\profiles\Individual\IndividualUserInvestOffer;
use App\Models\User;
use App\MoonShine\Resources\CompanyInvestProjectResource;
use App\MoonShine\Resources\IndividualUserResource;
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

class IndividualUserInvestOfferIndex extends Page
{
    protected string $layout = 'userprofile';

    public function title(): string
    {
        return $this->title ?: 'IndividualUserInvestOfferIndex';
    }


    public function itemsCompany(): Collection
    {
        return User::find(auth()->id())->individualUserInvestOffers;
    }

    public function itemsIndividualUserInvestOffer()
    {
        return IndividualUserInvestOffer::all()->where('individual_user_id', $this->itemsCompany());
    }

    public function fields(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Название', 'name')->showOnExport(),
            Text::make('Краткая информация', 'basic_information')->showOnExport(),
            BelongsTo::make(
                'Компания',
                'individualUser',
                resource: new IndividualUserResource())
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
                ->cast(ModelCast::make(IndividualUserInvestOffer::class))
                ->buttons([


                    actionbutton::make('', fn(
                        IndividualUserInvestOffer $individualUserInvestOffer
                    ) => route(
                        'individual.invest.offers.details.index',
                        [
                            'user' => auth()->user()->getattribute('name'),
                            'id' => $individualUserInvestOffer->getkey(),
                        ]
                    )
                    )
                        ->icon('heroicons.outline.eye'),

                    actionbutton::make('', fn(IndividualUserInvestOffer $individualUserInvestOffer) => route(
                        'individual.invest.offers.delete', [
                        'user' => auth()->user()->getattribute('name'),
                        'id' => $individualUserInvestOffer->getkey()])
                    )
                        ->async(method: 'delete')
                        ->error()
                        ->icon('heroicons.outline.trash'),
                ]),
        ];
    }
}

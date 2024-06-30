<?php

declare(strict_types=1);

namespace App\Pages\profiles\companies;

use App\Models\profiles\companies\Company;
use App\MoonShine\Resources\CompanyInvestOfferResource;
use App\MoonShine\Resources\CompanyInvestProjectResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\FormBuilder;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Heading;
use MoonShine\Decorations\LineBreak;
use MoonShine\Enums\JsEvent;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Relationships\HasOne;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\Support\AlpineJs;
use MoonShine\TypeCasts\ModelCast;

class CompanyIndex extends Page
{
    protected string $layout = 'userprofile';

    public function title(): string
    {
        return $this->title ?: 'CompanyIndex';
    }

    public function fields(): array
    {
        return [
//            ID::make()->sortable()->showOnExport(),
            Text::make('Название', 'name')->showOnExport(),
            Text::make('ИНН', 'inn')->showOnExport(),
            Text::make('ОГРН', 'ogrn')->showOnExport(),
            HasMany::make(
                'Инвестиционный проект',
                'companyInvestProject',
                resource: new CompanyInvestProjectResource())
            ->fields([
                Text::make('Название', 'name')
            ]),
            HasMany::make(
                'Инвестиционное предложение',
                'companyInvestOffer',
                resource: new CompanyInvestOfferResource())
                ->fields([
                    Text::make('Название', 'name')
                ])
        ];
    }

    public function items(): LengthAwarePaginator
    {
        return Company::query()->where('user_id', auth()->id())->paginate();
    }

    /**
     * @inheritDoc
     */
    public function components(): array
    {
        return [
            ActionButton::make('добавить компанию', route('company.create',
                parameters: ['user' => auth()->user()->getAttribute('name')]))
                ->icon('heroicons.outline.plus')
                ->primary(),

            LineBreak::make(),

            TableBuilder::make()
                ->name('company-index')
                ->async()
                ->items($this->items())
                ->fields($this->fields())
                ->cast(ModelCast::make(Company::class))
                ->buttons([
                    ActionButton::make('', fn(Company $company) => route
                    (
                        'company.details.index',
                        parameters: [
                            'user' => auth()->user()->getAttribute('name'),
                            'id' => $company->getKey(),
                        ]
                    )
                    )
                        ->icon('heroicons.outline.eye'),

                    ActionButton::make('', fn(Company $company) => route(
                        'company.delete', [
                        'user' => auth()->user()->getAttribute('name'),
                        'id' => $company->getKey()])
                    )
                        ->inModal(
                            'Удалить',
                            fn(Company $company) => FormBuilder::make(route(
                                    'company.delete', [
                                    'user' => auth()->user()->getAttribute('name'),
                                    'id' => $company->getKey()])
                            )->fields([
                                Hidden::make('_method')->setValue('DELETE'),
                                Heading::make('Вы уверены?')
                            ])
                                ->async(
                                    asyncEvents: [
                                        AlpineJs::event(JsEvent::TABLE_UPDATED, 'company-index')
                                    ]
                                )
                                ->submit('Подтвердить', ['class' => 'btn-secondary'])
                        )
                        ->error()
                        ->icon('heroicons.outline.trash'),
                ]),
        ];
    }
}

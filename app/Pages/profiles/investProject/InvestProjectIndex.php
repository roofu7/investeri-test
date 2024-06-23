<?php

declare(strict_types=1);

namespace App\Pages\profiles\investProject;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyContact;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

//use MoonShine\Pages\Pages;

class InvestProjectIndex extends Page
{
    protected string $layout = 'userprofile';

    public function title(): string
    {
        return $this->title ?: 'CompanyIndex';
    }

    public function fields(): array
    {
//        dd(1111);
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Название', 'name')->showOnExport(),
            Text::make('ИНН', 'inn')->showOnExport(),
            Text::make('ОГРН', 'ogrn')->showOnExport(),
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
            ActionButton::make('добавить компанию', route('company.create', parameters: ['user' => auth()->user()->getAttribute('name')]))
                ->icon('heroicons.outline.plus')
                ->primary(),

            LineBreak::make(),

            TableBuilder::make()
                ->items($this->items())
                ->fields($this->fields())
                ->cast(ModelCast::make(Company::class))
                ->buttons([
                    /*ActionButton::make('заполнить данные', fn(Company $company) => route('company.profile.create',
                        parameters: ['user' => auth()->user()->getAttribute('name'),
                            'company' => $company->getKey()
                        ]))
                        ->icon('heroicons.outline.pencil')->primary()
                        ->canSee(fn(Company $company) => !$company->newQuery()->find($company->getKey())
                            ->companyActualLocation
                        ),

                    ActionButton::make('редактировать', fn(Company $company) => route('company.profile.create',
                        parameters: ['user' => auth()->user()->getAttribute('name'),
                            'company' => $company->getKey()
                        ]))
                        ->icon('heroicons.outline.pencil')
                        ->canSee(fn(Company $company) => !!$company->newQuery()->find($company->getKey())
                            ->companyActualLocation
                        ),*/

                    ActionButton::make('', fn(Company $company) => route
                    (
                        'company.details.index',
                        [
                            'user' => auth()->user()->getAttribute('name'),
                            'id' => $company->getKey(),
                        ]
                    )
                    )
                        ->icon('heroicons.outline.eye'),

                    ActionButton::make('', fn(Company $company) => route(
                        'company.delete',
                        ['user' => auth()->user()->getAttribute('name'), 'id' => $company->getKey()])
                    )
                        ->async(method: 'DELETE')
                        ->error()
                        ->icon('heroicons.outline.trash'),
                ]),
        ];
    }
}

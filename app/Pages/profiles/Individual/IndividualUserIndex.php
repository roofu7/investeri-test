<?php

declare(strict_types=1);

namespace App\Pages\profiles\Individual;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyContact;
use App\Models\profiles\Individual\IndividualUser;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

class IndividualUserIndex extends Page
{
    protected string $layout = 'userprofile';

    public function title(): string
    {
        return $this->title ?: 'IndividualUserIndex';
    }

    public function fields(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('ФИО', 'full_name')->showOnExport(),
            Text::make('ИНН', 'inn')->showOnExport(),
        ];
    }

    public function hasId(): bool
    {
        return IndividualUser::query()
            ->where('user_id', auth()->id())
            ->exists();
    }
    public function items(): LengthAwarePaginator
    {
        return IndividualUser::query()
            ->where('user_id', auth()->id())
            ->paginate();
    }

    /**
     * @inheritDoc
     */
    public function components(): array
    {
        return [
            ActionButton::make('Создать Физлицо', route('individual.create',
                parameters: ['user' => auth()->user()->getAttribute('name')]))
                ->canSee(fn() => !$this->hasId())
                ->icon('heroicons.outline.plus')
                ->primary(),

            TableBuilder::make()
                ->items($this->items())
                ->fields($this->fields())
                ->cast(ModelCast::make(IndividualUser::class))
                ->buttons([
                    ActionButton::make('', fn(IndividualUser $individualUser) => route(
                        'individual.details.index',
                        parameters: [
                            'user' => auth()->user()->getAttribute('name'),
                            'id' => $individualUser->getKey()
                        ]))
                        ->icon('heroicons.outline.eye')->primary(),

//                    ActionButton::make('редактировать', fn(Company $company) => route('company.profile.create',
//                        parameters: ['user' => auth()->user()->getAttribute('name'),
//                            'company' => $company->getKey()
//                        ]))
//                        ->icon('heroicons.outline.pencil')
//                        ->canSee(fn(Company $company) => !!$company->newQuery()->find($company->getKey())
//                            ->companyActualLocation
//                        ),
//
//                    ActionButton::make('', fn(Company $company) => route
//                    (
//                        'company.details.index',
//                        [
//                            'user' => auth()->user()->getAttribute('name'),
//                            'id' => $company->getKey(),
//                        ]
//                    )
//                    )
//                        ->icon('heroicons.outline.eye'),
//
//                    ActionButton::make('', fn(Company $company) => route(
//                        'company.delete',
//                        ['user' => auth()->user()->getAttribute('name'), 'id' => $company->getKey()])
//                    )
//                        ->async(method: 'DELETE')
//                        ->error()
//                        ->icon('heroicons.outline.trash'),
                ]),
        ];
    }
}

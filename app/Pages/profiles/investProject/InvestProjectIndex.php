<?php

declare(strict_types=1);

namespace App\Pages\profiles\investProject;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyContact;
use App\Models\profiles\companies\CompanyInvestProject;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;
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
        return $this->title ?: 'InvestProjectIndex';
    }


    public function itemsCompany(): \Illuminate\Database\Eloquent\Collection
    {
        return User::find(auth()->id())->companyInvestProjects;
//        dd($t);
//        return Company::query()->where('user_id', auth()->id())->paginate();
//        $map = $company->map(function ($company) {
//            return $company->id;
//        });
//        dd($company->collect());
    }

    public function itemsCompanyInvestProject()
    {
//        $id = $this->itemsCompany();
//        foreach ($id as $item) {
//            dd($item);
//        }
        return CompanyInvestProject::all()->where('company_id',$this->itemsCompany());
//        foreach ($invest as $item) {
//            dd($item->id);
//        }
//        dd($invest);
    }

    public function fields(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Название', 'name')->showOnExport(),
            Text::make('Краткая информация', 'basic_information')->showOnExport(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function components(): array
    {
        return [
            ActionButton::make('добавить проект', route('invest.projects.create', parameters: ['user' => auth()->user()->getAttribute('name')]))
                ->icon('heroicons.outline.plus')
                ->primary(),

            LineBreak::make(),

            TableBuilder::make()
                ->items($this->itemsCompany())
                ->fields($this->fields())
                ->cast(ModelCast::make(CompanyInvestProject::class)),
//                ->buttons([
//                    /*ActionButton::make('заполнить данные', fn(Company $company) => route('company.profile.create',
//                        parameters: ['user' => auth()->user()->getAttribute('name'),
//                            'company' => $company->getKey()
//                        ]))
//                        ->icon('heroicons.outline.pencil')->primary()
//                        ->canSee(fn(Company $company) => !$company->newQuery()->find($company->getKey())
//                            ->companyActualLocation
//                        ),
//
//                    ActionButton::make('редактировать', fn(Company $company) => route('company.profile.create',
//                        parameters: ['user' => auth()->user()->getAttribute('name'),
//                            'company' => $company->getKey()
//                        ]))
//                        ->icon('heroicons.outline.pencil')
//                        ->canSee(fn(Company $company) => !!$company->newQuery()->find($company->getKey())
//                            ->companyActualLocation
//                        ),*/
//
//                    /*actionbutton::make('', fn(company $company) => route
//                    (
//                        'company.details.index',
//                        [
//                            'user' => auth()->user()->getattribute('name'),
//                            'id' => $company->getkey(),
//                        ]
//                    )
//                    )
//                        ->icon('heroicons.outline.eye'),
//
//                    actionbutton::make('', fn(company $company) => route(
//                        'company.delete',
//                        ['user' => auth()->user()->getattribute('name'), 'id' => $company->getkey()])
//                    )
//                        ->async(method: 'delete')
//                        ->error()
//                        ->icon('heroicons.outline.trash'),*/
//                ]),
        ];
    }
}

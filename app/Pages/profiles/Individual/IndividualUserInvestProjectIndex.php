<?php

declare(strict_types=1);

namespace App\Pages\profiles\Individual;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyContact;
use App\Models\profiles\companies\CompanyInvestProject;
use App\Models\profiles\Individual\IndividualUser;
use App\Models\profiles\Individual\IndividualUserInvestProject;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;


class IndividualUserInvestProjectIndex extends Page
{
    protected string $layout = 'userprofile';

    public function title(): string
    {
        return $this->title ?: 'IndividualUserInvestProjectIndex';
    }


//    public function hasIndividualUser()
//    {
//        $individualUser = IndividualUser::query()
//            ->where('user_id', auth()->id())->exists();
//        if (!$individualUser) {
//            dd('Зарегистрируйте физлицо');
//        }
//        $r = IndividualUser::query()
//            ->find('user_id', auth()->id())->individualUserInvestProject;
//        dd('ffffff',$r);
//    }

    public function hasIndividualUserInvestProject(): \Illuminate\Database\Eloquent\Collection
    {
        return User::find(auth()->id())->individualUserInvestProjects;

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
            TableBuilder::make()
                ->items($this->hasIndividualUserInvestProject())
                ->fields($this->fields())
                ->cast(ModelCast::make(IndividualUserInvestProject::class))
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

                    actionbutton::make('', fn(IndividualUserInvestProject $individualUserInvestProject) => route
                    (
                        'individual.invest.projects.details.index',
                        [
                            'user' => auth()->user()->getattribute('name'),
                            'id' => $individualUserInvestProject->getkey(),
                        ]
                    )
                    )
                        ->icon('heroicons.outline.eye'),

                    actionbutton::make('', fn(IndividualUserInvestProject $individualUserInvestProject) => route(
                        'individual.invest.projects.delete',
                        ['user' => auth()->user()->getattribute('name'), 'id' => $individualUserInvestProject->getkey()])
                    )
                        ->async(method: 'delete')
                        ->error()
                        ->icon('heroicons.outline.trash'),
                ]),
        ];
    }
}

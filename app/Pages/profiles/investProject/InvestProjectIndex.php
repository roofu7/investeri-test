<?php

declare(strict_types=1);

namespace App\Pages\profiles\investProject;

use App\Models\profiles\companies\CompanyInvestProject;
use App\Models\User;
use App\MoonShine\Resources\CompanyInvestProjectResource;
use App\MoonShine\Resources\UserCompanyResource;
use Illuminate\Database\Eloquent\Collection;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\FormBuilder;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Heading;
use MoonShine\Enums\JsEvent;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasManyThrough;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\Support\AlpineJs;
use MoonShine\TypeCasts\ModelCast;

//use MoonShine\Pages\Pages;

class InvestProjectIndex extends Page
{
    protected string $layout = 'userprofile';

    public function title(): string
    {
        return $this->title ?: 'InvestProjectIndex';
    }


    public function itemsCompany(): Collection
    {
        return User::find(auth()->id())->companyInvestProjects;
    }

    public function itemsCompanyInvestProject()
    {
        return CompanyInvestProject::all()->where('company_id', $this->itemsCompany());
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
                ->cast(ModelCast::make(CompanyInvestProject::class))
                ->buttons([


                    actionbutton::make('', fn(CompanyInvestProject $companyInvestProject) => route
                    (
                        'company.invest.projects.details.index',
                        [
                            'user' => auth()->user()->getattribute('name'),
                            'id' => $companyInvestProject->getkey(),
                        ]
                    )
                    )
                        ->name('company-index')
                        ->async()
                        ->icon('heroicons.outline.eye'),

                    ActionButton::make('', fn(CompanyInvestProject $companyInvestProject) => route(
                        'company.invest.projects.delete', [
                            'user' => auth()->user()->getAttribute('name'),
                            'id' => $companyInvestProject->getKey()
                        ]
                    )
                    )
                        ->inModal(
                            'Удалить',
                            fn(CompanyInvestProject $companyInvestProject) => FormBuilder::make(route(
                                    'company.invest.projects.delete', [
                                        'user' => auth()->user()->getAttribute('name'),
                                        'id' => $companyInvestProject->getKey()
                                    ]
                                )
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

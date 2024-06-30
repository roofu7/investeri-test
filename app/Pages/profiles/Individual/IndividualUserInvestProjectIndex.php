<?php

declare(strict_types=1);

namespace App\Pages\profiles\Individual;

use App\Models\profiles\Individual\IndividualUserInvestProject;
use App\Models\User;
use App\MoonShine\Resources\IndividualUserResource;
use Illuminate\Database\Eloquent\Collection;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\FormBuilder;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Heading;
use MoonShine\Enums\JsEvent;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\Support\AlpineJs;
use MoonShine\TypeCasts\ModelCast;


/**
 *
 */
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


    /**
     * @return Collection
     */
    public function hasIndividualUserInvestProject(): Collection
    {
        return User::find(auth()->id())->individualUserInvestProjects;
    }

    public function fields(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Название', 'name')->showOnExport(),
            Text::make('Краткая информация', 'basic_information')->showOnExport(),
            BelongsTo::make(
                'Физлицо',
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
                ->items($this->hasIndividualUserInvestProject())
                ->fields($this->fields())
                ->cast(ModelCast::make(IndividualUserInvestProject::class))
                ->buttons([
                    actionbutton::make('', fn(IndividualUserInvestProject $individualUserInvestProject) => route
                    (
                        'individual.invest.projects.index',
                        [
                            'user' => auth()->user()->getattribute('name'),
                            'id' => $individualUserInvestProject->getkey(),
                        ]
                    )
                    )
                        ->icon('heroicons.outline.eye'),

                    ActionButton::make('', fn(IndividualUserInvestProject $individualUserInvestProject) => route(
                        'individual.invest.projects.delete', [
                        'user' => auth()->user()->getAttribute('name'),
                        'id' => $individualUserInvestProject->getKey()])
                    )
                        ->inModal(
                            'Удалить',
                            fn(IndividualUserInvestProject $individualUserInvestProject) => FormBuilder::make(route(
                                    'individual.invest.projects.delete', [
                                    'user' => auth()->user()->getAttribute('name'),
                                    'id' => $individualUserInvestProject->getKey()])
                            )->fields([
                                Hidden::make('_method')->setValue('DELETE'),
                                Heading::make('Вы уверены?')
                            ])
                                ->async(
                                    asyncEvents: [
                                        AlpineJs::event(JsEvent::TABLE_UPDATED, 'individual-index')
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

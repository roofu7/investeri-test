<?php

declare(strict_types=1);

namespace App\Pages\profiles\Individual;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyContact;
use App\Models\profiles\Individual\IndividualUser;
use App\Models\User;
use App\MoonShine\Resources\IndividualUserInvestOfferResource;
use App\MoonShine\Resources\IndividualUserInvestProjectResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\FormBuilder;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Heading;
use MoonShine\Decorations\LineBreak;
use MoonShine\Enums\JsEvent;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\Support\AlpineJs;
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
            HasMany::make(
                'Инвестиционный проект',
                'individualUserProject',
                resource: new IndividualUserInvestProjectResource())
                ->fields([
                    Text::make('Название', 'name')
                ]),
            HasMany::make(
                'Инвестиционное предложение',
                'individualUserOffer',
                resource: new IndividualUserInvestOfferResource())
                ->fields([
                    Text::make('Название', 'name')
                ])
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
                ->name('individual-index')
                ->async()
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

                    ActionButton::make('', fn(IndividualUser $individualUser) => route(
                        'individual.delete', [
                        'user' => auth()->user()->getAttribute('name'),
                        'id' => $individualUser->getKey()])
                    )
                        ->inModal(
                            'Удалить',
                            fn(IndividualUser $individualUser) => FormBuilder::make(route(
                                    'individual.delete', [
                                    'user' => auth()->user()->getAttribute('name'),
                                    'id' => $individualUser->getKey()])
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

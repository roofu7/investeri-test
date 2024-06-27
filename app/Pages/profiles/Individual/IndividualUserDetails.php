<?php

declare(strict_types=1);

namespace App\Pages\profiles\Individual;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyActualLocation;
use App\Models\profiles\companies\CompanyContact;
use App\Models\profiles\companies\CompanyInvestProject;
use App\Models\profiles\Individual\IndividualUser;
use App\Models\profiles\Individual\IndividualUserAddress;
use App\Models\profiles\Individual\IndividualUserContact;
use App\Models\profiles\Individual\IndividualUserInvestOffer;
use App\Models\profiles\Individual\IndividualUserInvestProject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Collapse;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Fields;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

class IndividualUserDetails extends Page
{
    protected ?Company $itemIndividualUser = null;
    protected ?Company $itemIndividualUserContact = null;
    protected ?CompanyActualLocation $itemIndividualUserAddress = null;
    protected ?CompanyInvestProject $itemIndividualUserInvestProject = null;
    protected ?IndividualUserInvestOffer $itemIndividualUserInvestOffer = null;

    protected string $layout = 'userprofile';
    protected string $title = 'IndividualUserDetails';

    /*------------------------------------------------ Individual User -----------------------------------------------*/
    public function hasRequest(): bool
    {
        return !!request('id');
    }

    public function getItemIndividualUser(): Model|Collection|Builder|Company|array|null
    {
        if (!is_null($this->itemIndividualUser)) {
            return $this->itemIndividualUser;
        }
        return IndividualUser::query()->findOrFail(request('id'));
    }

    public function fieldsCompany(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('ФИО', 'full_name')->required()->showOnExport(),
            Text::make('ИНН', 'inn')->required()->showOnExport(),
        ];
    }

    /*------------------------------------------- Individual User Contact --------------------------------------------*/
    public function itemsIndividualUserContact()
    {
        $r = IndividualUserContact::all()->where('individual_user_id', request('id'));
        foreach ($r as $item) {
            return ($item['id']);
        }
        return ([]);
    }

    public function hasIndividualUserContact(): bool
    {
        return IndividualUserContact::query()
            ->where('individual_user_id', request('id'))
            ->exists();
    }

    public function getIndividualUserContact(): Model|Collection|Builder|Company|array|null
    {
        if (!is_null($this->itemIndividualUserContact)) {
            return $this->itemIndividualUserContact;
        }
        return IndividualUserContact::query()->findOrFail($this->itemsIndividualUserContact());
    }

    public function fieldsIndividualUserContact(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Электронная почта', 'email')->required()->showOnExport(),
            Text::make('Телефон', 'phone')->required()->showOnExport(),
            Hidden::make('individual_user_id')->setValue(request('id'))->required()->showOnExport(),
        ];
    }

    /*------------------------------------------ Individual User Address ---------------------------------------------*/
    public function itemsIndividualUserAddress()
    {
        $r = IndividualUserAddress::all()->where('individual_user_id', request('id'));
        foreach ($r as $item) {
            return ($item['id']);
        }
        return ([]);
    }

    public function hasIndividualUserAddress(): bool
    {
        return IndividualUserAddress::query()
            ->where('individual_user_id', request('id'))
            ->exists();
    }

    public function getIndividualUserAddress(): Model|Collection|Builder|Company|array|null
    {
        if (!is_null($this->itemIndividualUserAddress)) {
            return $this->itemIndividualUserAddress;
        }
        return IndividualUserAddress::query()->findOrFail($this->itemsIndividualUserAddress());
    }

    public function fieldsIndividualUserAddress(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Регион', 'region')->required()->showOnExport(),
            Text::make('Город', 'city')->required()->showOnExport(),
            Text::make('Улица', 'street')->required()->showOnExport(),
            Text::make('Номер дома', 'house_number')->required()->showOnExport(),
            Text::make('Корпус', 'building_number')->required()->showOnExport(),
            Text::make('Номер комнаты', 'room_number')->required()->showOnExport(),
            Hidden::make('individual_user_id')->setValue(request('id'))->required()->showOnExport(),
        ];
    }

    /*------------------------------------------------ InvestProject -------------------------------------------------*/

    public function itemsIndividualUserInvestProject()
    {
        $r = IndividualUserInvestProject::all()->where('individual_user_id', request('id'));
        foreach ($r as $item) {
            return ($item['id']);
        }
        return ([]);
    }

    public function hasIndividualUserInvestProject(): bool
    {
        return IndividualUserInvestProject::query()
            ->where('individual_user_id', request('id'))
            ->exists();
    }

    public function getIndividualUserInvestProject(): Model|Collection|CompanyActualLocation|Builder|array|null
    {
        if (!is_null($this->itemIndividualUserInvestProject)) {
            return $this->itemIndividualUserInvestProject;
        }
        return IndividualUserInvestProject::query()
            ->findOrFail($this->itemsIndividualUserInvestProject());
    }

    public function fieldsIndividualUserInvestProject(): array
    {
        return [
            ID::make()
                ->sortable()
                ->showOnExport(),
            Text::make('Название', 'name')
                ->required()
                ->showOnExport(),
            Textarea::make('Краткая информация', 'basic_information')
                ->required()
                ->showOnExport(),
            Hidden::make('individual_user_id')
                ->setValue(request('id'))
                ->required()
                ->showOnExport(),
        ];
    }


    /*------------------------------------------------ InvestOffer -------------------------------------------------*/

    public function itemsIndividualUserInvestOffer()
    {
        $r = IndividualUserInvestOffer::all()->where('individual_user_id', request('id'));
        foreach ($r as $item) {
            return ($item['id']);
        }
        return ([]);
    }

    public function hasIndividualUserInvestOffer(): bool
    {
        return IndividualUserInvestOffer::query()
            ->where('individual_user_id', request('id'))
            ->exists();
    }

    public function getIndividualUserInvestOffer(): Model|Collection|CompanyActualLocation|Builder|array|null
    {
        if (!is_null($this->itemIndividualUserInvestOffer)) {
            return $this->itemIndividualUserInvestOffer;
        }
        return IndividualUserInvestOffer::query()
            ->findOrFail($this->itemsIndividualUserInvestOffer());
    }

    public function fieldsIndividualUserInvestOffer(): array
    {
        return [
            ID::make()
                ->sortable()
                ->showOnExport(),
            Text::make('Название', 'name')
                ->required()
                ->showOnExport(),
            Textarea::make('Краткая информация', 'basic_information')
                ->required()
                ->showOnExport(),
            Hidden::make('individual_user_id')
                ->setValue(request('id'))
                ->required()
                ->showOnExport(),
        ];
    }

    public function components(): array
    {
        $dataIndividualUser = $this->hasRequest()
            ? $this->getItemIndividualUser()
            : new IndividualUser();
        $dataIndividualUserContact = $this->hasIndividualUserContact()
            ? $this->getIndividualUserContact()
            : new IndividualUserContact();
        $dataIndividualUserAddress = $this->hasIndividualUserAddress()
            ? $this->getIndividualUserAddress()
            : new IndividualUserAddress();
        $dataIndividualUserInvestProject = $this->hasIndividualUserInvestProject()
            ? $this->getIndividualUserInvestProject()
            : new IndividualUserInvestProject();
        $dataIndividualUserInvestOffer = $this->hasIndividualUserInvestOffer()
            ? $this->getIndividualUserInvestOffer()
            : new IndividualUserInvestOffer();

        $actionContact = $this->hasIndividualUserContact()
            ? route('individual.contact.update', $dataIndividualUserContact)
            : route('individual.contact.store',
                parameters: ['user' => auth()->user()->getAttribute('name')]);
        $actionAddress = $this->hasIndividualUserAddress()
            ? route('individual.address.update', $dataIndividualUserAddress)
            : route('individual.address.store',
                parameters: ['user' => auth()->user()->getAttribute('name')]);
        $actionInvestProject = $this->hasIndividualUserInvestProject()
            ? route('individual.invest.projects.update', $dataIndividualUserInvestProject)
            : route('individual.invest.projects.store',
                parameters: ['user' => auth()->user()->getAttribute('name')]);
        $actionInvestOffer = $this->hasIndividualUserInvestOffer()
            ? route('individual.invest.offers.update', $dataIndividualUserInvestOffer)
            : route('individual.invest.offers.store',
                parameters: ['user' => auth()->user()->getAttribute('name')]);

        return [
            Grid::make([
                Column::make([
                    Collapse::make('Профиль Компании', [
                        Grid::make([
                            Column::make([
                                Block::make('Редактировать Данные Компании', [
                                    FormBuilder::make(route('individual.update', $dataIndividualUser))
                                        ->fields(
                                            Fields::make($this->fieldsCompany())
                                                ->when(
                                                    $this->hasRequest(),
                                                    fn(Fields $fields) => $fields->push(
                                                        Hidden::make('_method')->setValue('PUT')
                                                    )
                                                )
                                        )
                                        ->FillCast($dataIndividualUser, ModelCast::make(IndividualUser::class))
                                        ->async(),
                                ]),
                            ])->columnSpan(4),
                            Column::make([
                                Block::make($this->hasIndividualUserContact()
                                    ? 'Редактировать Контакты'
                                    : 'Заполнить Контакты', [
                                    FormBuilder::make($actionContact)
                                        ->fields(
                                            Fields::make($this->fieldsIndividualUserContact())
                                                ->when(
                                                    $this->hasIndividualUserContact(),
                                                    fn(Fields $fields) => $fields->push(
                                                        Hidden::make('_method')->setValue('PUT')
                                                    )
                                                )
                                        )->FillCast(
                                            $dataIndividualUserContact,
                                            ModelCast::make(IndividualUserContact::class)
                                        )->async(),
                                ]),
                            ])->columnSpan(4),
                            Column::make([
                                Block::make($this->hasIndividualUserAddress()
                                    ? 'Редактировать Адрес'
                                    : 'Заполнить Адрес', [
                                    FormBuilder::make($actionAddress)
                                        ->fields(
                                            Fields::make($this->fieldsIndividualUserAddress())
                                                ->when(
                                                    $this->hasIndividualUserAddress(),
                                                    fn(Fields $fields) => $fields->push(
                                                        Hidden::make('_method')->setValue('PUT')
                                                    )
                                                )
                                        )->FillCast(
                                            $dataIndividualUserAddress,
                                            ModelCast::make(IndividualUserAddress::class)
                                        )->async(),
                                ]),
                            ])->columnSpan(4),
                        ]),
                    ]),
                ])->columnSpan(8),
                Column::make([
                    Collapse::make($this->hasIndividualUserInvestProject()
                        ? 'Редактировать Инвестиционный проект'
                        : 'Создать Инвестиционный проект', [
                        FormBuilder::make($actionInvestProject)
                            ->fields(
                                Fields::make($this->fieldsIndividualUserInvestProject())
                                    ->when(
                                        $this->hasIndividualUserInvestProject(),
                                        fn(Fields $fields) => $fields->push(
                                            Hidden::make('_method')->setValue('PUT')
                                        )
                                    )
                            )
                            ->FillCast($dataIndividualUserInvestProject, ModelCast::make(IndividualUserInvestProject::class))
                            ->async(),
                    ]),
                    Collapse::make($this->hasIndividualUserInvestOffer()
                        ? 'Редактировать Инвестиционное предложение'
                        : 'Создать Инвестиционное предложение', [
                        FormBuilder::make($actionInvestOffer)
                            ->fields(
                                Fields::make($this->fieldsIndividualUserInvestOffer())
                                    ->when(
                                        $this->hasIndividualUserInvestOffer(),
                                        fn(Fields $fields) => $fields->push(
                                            Hidden::make('_method')->setValue('PUT')
                                        )
                                    )
                            )
                            ->FillCast($dataIndividualUserInvestOffer, ModelCast::make(IndividualUserInvestOffer::class))
                            ->async(),
                    ]),
                ])->columnSpan(4),
            ]),
        ];
    }
}

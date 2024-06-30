<?php

declare(strict_types=1);

namespace App\Pages\profiles\companies;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyActualLocation;
use App\Models\profiles\companies\CompanyContact;
use App\Models\profiles\companies\CompanyInvestOffer;
use App\Models\profiles\companies\CompanyInvestProject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Collapse;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Fields;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Fields\TinyMce;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

class CompanyDetails extends Page
{
    protected ?Company $itemCompany = null;
    protected ?Company $itemCompanyContact = null;
    protected ?CompanyActualLocation $itemCompanyActualLocation = null;
    protected ?CompanyInvestProject $itemCompanyInvestProject = null;
    protected ?CompanyInvestOffer $itemCompanyInvestOffer = null;

    protected string $layout = 'userprofile';
    protected string $title = 'CompanyDetails';

    /*--------------------------------------------------- Company ----------------------------------------------------*/
    public function hasRequest(): bool
    {
        return !!request('id');
    }

    public function getItemCompany(): Model|Collection|Builder|Company|array|null
    {
        if (!is_null($this->itemCompany)) {
            return $this->itemCompany;
        }
        return Company::query()->findOrFail(request('id'));
    }

    public function fieldsCompany(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Название', 'name')->required()->showOnExport(),
            Text::make('ИНН', 'inn')->required()->showOnExport(),
            Text::make('ОГРН', 'ogrn')->required()->showOnExport(),
        ];
    }

    /*------------------------------------------------ CompanyContact ------------------------------------------------*/
    public function itemsCompanyContact()
    {
        $r = CompanyContact::all()->where('company_id', request('id'));
        foreach ($r as $item) {
            return ($item['id']);
        }
        return ([]);
    }

    public function hasCompanyContact(): bool
    {
        return CompanyContact::query()
            ->where('company_id', request('id'))
            ->exists();
    }

    public function getItemCompanyContact(): Model|Collection|Builder|Company|array|null
    {
        if (!is_null($this->itemCompanyContact)) {
            return $this->itemCompanyContact;
        }
        return CompanyContact::query()->findOrFail($this->itemsCompanyContact());
    }

    public function fieldsCompanyContact(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Электронная почта', 'email')->required()->showOnExport(),
            Text::make('Телефон', 'phone')->required()->showOnExport(),
            Hidden::make('company_id')->setValue(request('id'))->required()->showOnExport(),
        ];
    }

    /*-------------------------------------------- CompanyActualLocation ---------------------------------------------*/
    public function itemsCompanyActualLocation()
    {
        $r = CompanyActualLocation::all()->where('company_id', request('id'));
        foreach ($r as $item) {
            return ($item['id']);
        }
        return ([]);
    }

    public function hasCompanyActualLocation(): bool
    {
        return CompanyActualLocation::query()
            ->where('company_id', request('id'))
            ->exists();
    }

    public function getItemCompanyActualLocation(): Model|Collection|Builder|Company|array|null
    {
        if (!is_null($this->itemCompanyActualLocation)) {
            return $this->itemCompanyActualLocation;
        }
        return CompanyActualLocation::query()->findOrFail($this->itemsCompanyActualLocation());
    }

    public function fieldsCompanyActualLocation(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Регион', 'region')->required()->showOnExport(),
            Text::make('Город', 'city')->required()->showOnExport(),
            Text::make('Улица', 'street')->required()->showOnExport(),
            Text::make('Номер дома', 'house_number')->required()->showOnExport(),
            Text::make('Корпус', 'building_number')->required()->showOnExport(),
            Text::make('Номер комнаты', 'room_number')->required()->showOnExport(),
            Hidden::make('company_id')->setValue(request('id'))->required()->showOnExport(),
        ];
    }

    /*------------------------------------------------ InvestProject -------------------------------------------------*/

    public function itemsCompanyInvestProject()
    {
        $r = CompanyInvestProject::all()->where('company_id', request('id'));
        foreach ($r as $item) {
            return ($item['id']);
        }
        return ([]);
    }

    public function hasCompanyInvestProject(): bool
    {
        return CompanyInvestProject::query()
            ->where('company_id', request('id'))
            ->exists();
    }

    public function getItemCompanyInvestProject(): Model|Collection|CompanyActualLocation|Builder|array|null
    {
        if (!is_null($this->itemCompanyInvestProject)) {
            return $this->itemCompanyInvestProject;
        }
        return CompanyInvestProject::query()->findOrFail($this->itemsCompanyInvestProject());
    }

    public function fieldsCompanyInvestProject(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Название', 'name')->required()->showOnExport(),
            TinyMce::make('Краткая информация', 'basic_information')->required()->showOnExport(),
//            Textarea::make('Краткая информация', 'basic_information')->required()->showOnExport(),
            Hidden::make('company_id')->setValue(request('id'))->required()->showOnExport(),
        ];
    }

    /*------------------------------------------------ InvestOffer -------------------------------------------------*/

    public function itemsCompanyInvestOffer()
    {
        $r = CompanyInvestOffer::all()->where('company_id', request('id'));
        foreach ($r as $item) {
            return ($item['id']);
        }
        return ([]);
    }

    public function hasCompanyInvestOffer(): bool
    {
        return CompanyInvestOffer::query()
            ->where('company_id', request('id'))
            ->exists();
    }

    public function getItemCompanyInvestOffer(): Model|Collection|CompanyActualLocation|Builder|array|null
    {
        if (!is_null($this->itemCompanyInvestOffer)) {
            return $this->itemCompanyInvestOffer;
        }
        return CompanyInvestOffer::query()->findOrFail($this->itemsCompanyInvestOffer());
    }

    public function fieldsCompanyInvestOffer(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Название', 'name')->required()->showOnExport(),
            Textarea::make('Краткая информация', 'basic_information')->required()->showOnExport(),
            Hidden::make('company_id')->setValue(request('id'))->required()->showOnExport(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function components(): array
    {
        $dataCompany = $this->hasRequest()
            ? $this->getItemCompany()
            : new Company();
        $dataCompanyContact = $this->hasCompanyContact()
            ? $this->getItemCompanyContact()
            : new CompanyContact();
        $dataCompanyActualLocation = $this->hasCompanyActualLocation()
            ? $this->getItemCompanyActualLocation()
            : new CompanyActualLocation();
        $dataCompanyInvestProject = $this->hasCompanyInvestProject()
            ? $this->getItemCompanyInvestProject()
            : new CompanyInvestProject();
        $dataCompanyInvestOffer = $this->hasCompanyInvestOffer()
            ? $this->getItemCompanyInvestOffer()
            : new CompanyInvestOffer();

//        $actionCompany = $this->hasRequest()
//            ? route('samupdate', $dataCompany)
//            : route('');
        $actionContact = $this->hasCompanyContact()
            ? route('company.contact.update', $dataCompanyContact)
            : route('company.contact.store',
                parameters: ['user' => auth()->user()->getAttribute('name')]);
        $actionActualLocation = $this->hasCompanyActualLocation()
            ? route('company.actual.address.update', $dataCompanyActualLocation)
            : route('company.actual.address.store',
                parameters: ['user' => auth()->user()->getAttribute('name')]);
        $actionInvestProject = $this->hasCompanyInvestProject()
            ? route('company.invest.projects.update', $dataCompanyInvestProject)
            : route('company.invest.projects.store',
                parameters: ['user' => auth()->user()->getAttribute('name')]);
        $actionInvestOffer = $this->hasCompanyInvestOffer()
            ? route('company.invest.offers.update', $dataCompanyInvestOffer)
            : route('company.invest.offers.store',
                parameters: ['user' => auth()->user()->getAttribute('name')]);

        return [
            Grid::make([
                Column::make([
                    Collapse::make('Профиль Компании', [
                        Grid::make([
                            Column::make([
                                Block::make('Редактировать Данные Компании', [
                                    FormBuilder::make(route('company.update', $dataCompany))
                                        ->fields(
                                            Fields::make($this->fieldsCompany())
                                                ->when(
                                                    $this->hasRequest(),
                                                    fn(Fields $fields) => $fields->push(
                                                        Hidden::make('_method')->setValue('PUT')
                                                    )
                                                )
                                        )
                                        ->FillCast($dataCompany, ModelCast::make(Company::class))
                                        ->async(),
                                ]),
                            ])->columnSpan(4),
                            Column::make([
                                Block::make($this->hasCompanyContact() ? 'Редактировать Контакты' : 'Заполнить Контакты', [
                                    FormBuilder::make($actionContact)
                                        ->fields(
                                            Fields::make($this->fieldsCompanyContact())
                                                ->when(
                                                    $this->hasCompanyContact(),
                                                    fn(Fields $fields) => $fields->push(
                                                        Hidden::make('_method')->setValue('PUT')
                                                    )
                                                )
                                        )
                                        ->FillCast($dataCompanyContact, ModelCast::make(CompanyContact::class))
                                        ->async(),
                                ]),
                            ])->columnSpan(4),
                            Column::make([
                                Block::make($this->hasCompanyActualLocation() ? 'Редактировать Адрес' : 'Заполнить Адрес', [
                                    FormBuilder::make($actionActualLocation)
                                        ->fields(
                                            Fields::make($this->fieldsCompanyActualLocation())
                                                ->when(
                                                    $this->hasCompanyActualLocation(),
                                                    fn(Fields $fields) => $fields->push(
                                                        Hidden::make('_method')->setValue('PUT')
                                                    )
                                                )
                                        )
                                        ->FillCast($dataCompanyActualLocation, ModelCast::make(CompanyActualLocation::class))
                                        ->async(),
                                ]),
                            ])->columnSpan(4),
                        ]),
                    ]),
                ])->columnSpan(8),
                Column::make([
                    Collapse::make($this->hasCompanyInvestProject() ? 'Редактировать Инвестиционный проект' : 'Создать Инвестиционный проект', [
                        FormBuilder::make($actionInvestProject)
                            ->fields(
                                Fields::make($this->fieldsCompanyInvestProject())
                                    ->when(
                                        $this->hasCompanyInvestProject(),
                                        fn(Fields $fields) => $fields->push(
                                            Hidden::make('_method')->setValue('PUT')
                                        )
                                    )
                            )
                            ->FillCast($dataCompanyInvestProject, ModelCast::make(CompanyInvestProject::class))
                            ->async(),
                    ]),
                        Collapse::make($this->hasCompanyInvestOffer()
                            ? 'Редактировать Инвестиционное предложение'
                            : 'Создать Инвестиционное предложение', [
                            FormBuilder::make($actionInvestOffer)
                                ->fields(
                                    Fields::make($this->fieldsCompanyInvestOffer())
                                        ->when(
                                            $this->hasCompanyInvestOffer(),
                                            fn(Fields $fields) => $fields->push(
                                                Hidden::make('_method')->setValue('PUT')
                                            )
                                        )
                                )
                                ->FillCast($dataCompanyInvestOffer, ModelCast::make(CompanyInvestOffer::class))
                                ->async(),
                        ])
                ])->columnSpan(4),
            ]),
        ];
    }
}

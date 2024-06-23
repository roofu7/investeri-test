<?php

declare(strict_types=1);

namespace App\Pages\profiles\companies;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyActualLocation;
use App\Models\profiles\companies\CompanyContact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\Divider;
use MoonShine\Fields\Fields;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

class CompanyDetails extends Page
{
    protected ?Company $itemCompany = null;
    protected ?Company $itemCompanyContact = null;

    protected string $layout = 'userprofile';
    protected string $title = 'CompanyDetails';

    /*------------------------------------------------ Company ----------------------------------------------------*/
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

    /*------------------------------------------------ CompanyContact ----------------------------------------------------*/
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

    /*------------------------------------------------ CompanyActualLocation ----------------------------------------------------*/
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
        if (!is_null($this->itemCompanyContact)) {
            return $this->itemCompanyContact;
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


    /**
     * @inheritDoc
     */
    public function components(): array
    {
        $dataCompany = $this->hasRequest() ? $this->getItemCompany() : new Company();
        $dataCompanyContact = $this->hasCompanyContact() ? $this->getItemCompanyContact() : new CompanyContact();
        $dataCompanyActualLocation = $this->hasCompanyActualLocation() ? $this->getItemCompanyActualLocation() : new CompanyActualLocation();

//        $actionCompany = $this->hasRequest()
//            ? route('samupdate', $dataCompany)
//            : route('');
        $actionContact = $this->hasCompanyContact()
            ? route('company.contact.update', $dataCompanyContact)
            : route('company.contact.store', parameters: ['user' => auth()->user()->getAttribute('name')]);
        $actionActualLocation = $this->hasCompanyActualLocation()
            ? route('company.actual.address.update', $dataCompanyActualLocation)
            : route('company.actual.address.store', parameters: ['user' => auth()->user()->getAttribute('name')]);

        return [
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

            Divider::make(),

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

            Divider::make(),

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
        ];
    }
}

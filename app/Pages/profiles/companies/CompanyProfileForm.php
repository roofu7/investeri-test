<?php

declare(strict_types=1);

namespace App\Pages\profiles\companies;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyActualLocation;
use App\Models\profiles\companies\CompanyContact;
use App\Models\profiles\companies\CompanyLegalLocation;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Collapse;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

class CompanyProfileForm extends Page
{
    protected string $layout = 'userprofile';
    protected ?Company $itemCompany = null;
    protected ?CompanyContact $itemCompanyContact = null;
    protected ?CompanyActualLocation $itemCompanyActualLocation = null;
    protected ?CompanyLegalLocation $itemCompanyLegalLocation = null;

    public function title(): string
    {
        return $this->title ?: 'CompanyForm';
    }

    protected function hasItemCompany(): bool
    {
        return request()->filled('id');
    }

    protected function getItemCompany(): Model
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

    /*
     * Контакты компании
    */
    public function itemsCompanyContact()
    {
        $r = CompanyContact::all()->where('company_id', $this->getItemCompany()->id);
        foreach ($r as $item) {
            return ($item['id']);
        }
        return ([]);
    }

    protected function hasItemCompanyContact(): bool
    {
        return CompanyContact::query()
            ->where('company_id', $this->getItemCompany()->id)
            ->exists();
    }

    protected function getItemCompanyContact(): Model
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
        ];
    }

    /*
     * Фактический адрес
    */
    public function itemsCompanyActualLocation()
    {
        $r = CompanyActualLocation::all()->where('company_id', $this->getItemCompany()->id);
        foreach ($r as $item) {
            return ($item['id']);
        }
        return ([]);
    }

    protected function hasItemCompanyActualLocation(): bool
    {
        return CompanyActualLocation::query()
            ->where('company_id', $this->getItemCompany()->id)
            ->exists();
    }

    protected function getItemCompanyActualLocation(): Model
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
            Text::make('Регион', 'email')->showOnExport(),
            Text::make('Город', 'phone')->showOnExport(),
            Text::make('Улица', 'phone')->showOnExport(),
            Text::make('Номер дома', 'phone')->showOnExport(),
            Text::make('Корпус', 'phone')->showOnExport(),
            Text::make('Номер комнаты', 'phone')->showOnExport(),
        ];
    }

    /*
     * Юридический адрес
    */
    public function itemsCompanyLegalLocation()
    {
        $r = CompanyLegalLocation::all()->where('company_id', $this->getItemCompany()->id);
        foreach ($r as $item) {
            return ($item['id']);
        }
        return ([]);
    }

    protected function hasItemCompanyLegalLocation(): bool
    {
        return CompanyLegalLocation::query()
            ->where('company_id', $this->getItemCompany()->id)
            ->exists();
    }

    protected function getItemCompanyLegalLocation(): Model
    {
        if (!is_null($this->itemCompanyLegalLocation)) {
            return $this->itemCompanyLegalLocation;
        }
        return CompanyLegalLocation::query()->findOrFail($this->itemsCompanyLegalLocation());
    }


    public function fieldsCompanyLegalLocation(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Регион', 'email')->showOnExport(),
            Text::make('Город', 'phone')->showOnExport(),
            Text::make('Улица', 'phone')->showOnExport(),
            Text::make('Номер дома', 'phone')->showOnExport(),
            Text::make('Корпус', 'phone')->showOnExport(),
            Text::make('Номер комнаты', 'phone')->showOnExport(),
        ];
    }

    /**
     * @inheritDoc
     */

    public function components(): array
    {
        $dataCompany = $this->hasItemCompany() ? $this->getItemCompany() : new Company();
        $dataCompanyContact = $this->hasItemCompanyContact() ? $this->getItemCompanyContact() : new CompanyContact();
        $dataCompanyActualLocation = $this->hasItemCompanyActualLocation() ? $this->getItemCompanyActualLocation() : new CompanyActualLocation();
        $dataCompanyLegalLocation = $this->hasItemCompanyLegalLocation() ? $this->getItemCompanyLegalLocation() : new CompanyLegalLocation();

        return [
            Block::make([
                Grid::make([
                    Column::make([
                        Block::make('Профиль', [
                            FormBuilder::make(route('companyprofilestore'))
                                ->fields($this->fieldsCompany())
                                ->FillCast($dataCompany, ModelCast::make(Company::class)),
                        ]),
                    ])->columnSpan(6),
                    Column::make([
                        Block::make('Контакты', [
                            FormBuilder::make(route('companyprofilestore'))
                                ->fields($this->fieldsCompanyContact())
                                ->FillCast($dataCompanyContact, ModelCast::make(CompanyContact::class)),
                        ]),
                    ])->columnSpan(6),
                ]),
            ]),

            LineBreak::make(),
            Divider::make(),
            LineBreak::make(),

            Collapse::make('Адрес', [
                Grid::make([
                    Column::make([
                        Block::make('Юридический адрес', [
                            FormBuilder::make(route('companyprofilestore'))
                                ->fields($this->fieldsCompanyActualLocation())
                                ->FillCast($dataCompanyLegalLocation, ModelCast::make(CompanyLegalLocation::class)),
                        ]),
                    ])->columnSpan(6),
                    Column::make([
                        Block::make('Фактический адрес', [
                            FormBuilder::make(route('companyprofilestore'))
                                ->fields($this->fieldsCompanyActualLocation())
                                ->FillCast($dataCompanyActualLocation, ModelCast::make(CompanyActualLocation::class)),
                        ]),
                    ])->columnSpan(6),
                ]),
            ]),

        ];
    }
}

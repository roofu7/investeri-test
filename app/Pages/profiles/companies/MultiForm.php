<?php

namespace App\Pages\profiles\companies;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyActualLocation;
use App\Models\profiles\companies\CompanyContact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\CardsBuilder;
use MoonShine\Components\FormBuilder;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;


class MultiForm extends Page
{
    protected string $layout = 'userprofile';
    protected string $title = 'Добавить';


    protected function hasItemCompany(): bool
    {
       return !!request('company');
    }

    protected function getItemCompany(): LengthAwarePaginator
    {
        return Company::query()
            ->newQuery()
            ->where('id', request('company'))
            ->paginate();
    }

    public function fieldsCompany(): array
    {
        return [
            Text::make('Название', 'name')->required()->showOnExport(),
            Text::make('ИНН', 'inn')->required()->showOnExport(),
            Text::make('ОГРН', 'ogrn')->required()->showOnExport(),
        ];
    }

    public function fieldsCompanyContact(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Электронная Почта', 'email')->required()->showOnExport(),
            Text::make('Телефон', 'phone')->required()->showOnExport(),
            Hidden::make('company_id')->setValue(request('company'))->required()->showOnExport(),

        ];
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
            Hidden::make('company_id')->setValue(request('company'))->required()->showOnExport(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function components(): array
    {
        $dataCompany = $this->hasItemCompany() ? $this->getItemCompany() : new Company();
//        dd($dataCompany);
        return [
            CardsBuilder::make()
                ->items($this->getItemCompany())
                ->fields($this->fieldsCompany())
                ->Cast(ModelCast::make(Company::class)),

            Divider::make(),

            Grid::make([
                Column::make([
                    Block::make('Контакты', [
                        FormBuilder::make(route('company.contact.store', parameters: ['user' => auth()->user()->getAttribute('name')]))
                            ->fields($this->fieldsCompanyContact())
                            ->Cast(ModelCast::make(CompanyContact::class))
                            ->async()
                    ])
                ])->columnSpan(6),
                Column::make([
                    Block::make('Фактический Адрес', [
                        FormBuilder::make(route('company.actual.address.store', parameters: ['user' => auth()->user()->getAttribute('name')]))
                            ->fields($this->fieldsCompanyActualLocation())
                            ->Cast(ModelCast::make(CompanyActualLocation::class))
                            ->async()
                    ])
                ])->columnSpan(6),
            ]),
        ];
    }
}

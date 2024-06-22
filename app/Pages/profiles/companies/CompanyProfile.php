<?php

declare(strict_types=1);

namespace App\Pages\profiles\companies;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyContact;
use MoonShine\Components\FormBuilder;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

class CompanyProfile extends Page
{
    protected string $layout = 'userprofile';
    protected string $title = 'Профиль компании';

    public function fieldsCompany(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Название', 'name')->required()->showOnExport(),
            Text::make('ИНН', 'inn')->required()->showOnExport(),
            Text::make('ОГРН', 'ogrn')->required()->showOnExport(),
        ];
    }


    /**
     * @inheritDoc
     */
    public function components(): array
    {
        return [
            FormBuilder::make()
                ->fields($this->fieldsCompany())
                ->Cast(ModelCast::make(Company::class)),
        ];
    }
}

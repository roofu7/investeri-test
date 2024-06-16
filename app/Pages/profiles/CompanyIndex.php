<?php

namespace App\Pages\profiles;

use App\Http\Controllers\CompanyFormController;
use App\Models\Company;
use App\Models\CompanyContact;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;

//use MoonShine\Pages\Pages;
use MoonShine\Pages\Pages;
use MoonShine\TypeCasts\ModelCast;

class CompanyIndex extends Page
{
    protected string $layout = 'userprofile';

    public function title(): string
    {
        return $this->title ?: 'CompanyIndex';
    }

    public function fields(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Название', 'name')->showOnExport(),
            Text::make('ИНН', 'inn')->showOnExport(),
            Text::make('ОГРН', 'ogrn')->showOnExport(),
        ];
    }

    public function items(): LengthAwarePaginator
    {
        return Company::query()->where('user_id', auth()->id())->paginate();
    }

    /**
     * @inheritDoc
     */
    public function components(): array
    {
        return [
            ActionButton::make('добавить компанию', route('companyprofile'))
                ->icon('heroicons.outline.plus')
                ->primary(),

            LineBreak::make(),

            TableBuilder::make()
                ->items($this->items())
                ->fields($this->fields())
                ->cast(ModelCast::make(Company::class))
                ->buttons([
                    ActionButton::make('заполнить данные', fn(Company $company) => route('create', parameters: ['id' => $company->getKey()]))
                        ->icon('heroicons.outline.pencil')->primary(),
                    ActionButton::make('редактировать', fn(Company $company) => route('create', parameters: ['id' => $company->getKey()]))
                        ->icon('heroicons.outline.pencil'),
                ]),
        ];
    }
}

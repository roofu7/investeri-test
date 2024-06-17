<?php

declare(strict_types=1);

namespace App\Pages\profiles\companies;

use App\Models\profiles\companies\Company;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

//use MoonShine\Pages\Pages;

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
            ActionButton::make('добавить компанию', url: fn () => route('company.create', parameters: ['id' => auth()->id()]))
                ->icon('heroicons.outline.plus')
                ->primary(),

            LineBreak::make(),

            TableBuilder::make()
                ->items($this->items())
                ->fields($this->fields())
                ->cast(ModelCast::make(Company::class))
                ->buttons([
                    ActionButton::make('заполнить данные', url: fn(Company $company) => route('company.store', parameters: ['id' => $company->getKey()]))
                        ->icon('heroicons.outline.pencil')->primary(),
                    ActionButton::make('редактировать', url: fn(Company $company) => route('company.update', parameters: ['id' => $company->getKey()]))
                        ->icon('heroicons.outline.pencil'),
                ]),
        ];
    }
}

<?php

namespace App\Pages\profiles;

use App\Http\Controllers\CompanyFormController;
use App\Models\CompanyContact;
use App\Models\User;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
//use MoonShine\Pages\Pages;
use MoonShine\Pages\Pages;
use MoonShine\TypeCasts\ModelCast;

class CompanyIndex extends Page
{
    protected string $layout = 'userprofile';
    protected string $title = 'Компания';

    /**
     * @inheritDoc
     */
    public function components(): array
    {
        return [
            ActionButton::make('добавить компанию', route('create'))
                ->icon('heroicons.outline.plus')
                ->primary(),
        ];
    }
}

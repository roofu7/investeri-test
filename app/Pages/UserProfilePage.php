<?php

declare(strict_types=1);

namespace App\Pages;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserAccountController;
use App\Models\Company;
use App\Models\CompanyContact;
use App\Models\User;
use App\MoonShine\Resources\CompanyContactResource;
use App\MoonShine\Resources\UserProfileResource;
use App\Pages\profiles\CompanyForm;
use App\Pages\profiles\CompanyIndex;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Card;
use MoonShine\Components\FormBuilder;
use MoonShine\Components\Layout\LayoutBlock;
use MoonShine\Components\Layout\LayoutBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\Sidebar;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Components\TableBuilder;
use MoonShine\Components\Url;
use MoonShine\Components\When;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\LineBreak;
use MoonShine\Decorations\Tab;
use MoonShine\Decorations\Tabs;
use MoonShine\Fields\Field;
use MoonShine\Fields\Fields;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasManyThrough;
use MoonShine\Fields\Text;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;
use function Laravel\Prompts\text;

class UserProfilePage extends Page
{
    protected string $layout = 'userprofile';
    protected string $title = 'Профиль';

    public function breadcrumbs(): array
    {
        return [
            '/user_profile' => 'Профиль'
        ];
    }

    public function components(): array
    {
        return [


            LineBreak::make(),
            Grid::make([
                Column::make([
                    Block::make('Мои компании', [
                        TableBuilder::make()
                            ->items(User::query()
                                ->where('id', auth()->id())
                                ->paginate())
                            ->fields([
                                Text::make('name')
                            ])
                            ->cast(ModelCast::make(User::class)),
                    ]),
                ])->columnSpan(6),
                Column::make([
                    Block::make('Мои компании', [
                        TableBuilder::make()
                            ->items(CompanyContact::query()
                                ->where('id', auth()->id())
                                ->paginate())
                            ->fields([
                                Text::make('phone')
                            ])
                            ->cast(ModelCast::make(CompanyContact::class)),
                    ]),
                ])->columnSpan(6),
            ]),

        ];
    }
}

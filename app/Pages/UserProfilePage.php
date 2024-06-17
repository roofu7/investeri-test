<?php

declare(strict_types=1);

namespace App\Pages;

use App\Models\profiles\companies\CompanyContact;
use App\Models\User;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

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

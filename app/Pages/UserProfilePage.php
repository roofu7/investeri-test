<?php

declare(strict_types=1);

namespace App\Pages;

use MoonShine\Components\FormBuilder;
use MoonShine\Components\Layout\Menu;
use MoonShine\Components\Layout\Profile;
use MoonShine\Components\Layout\Sidebar;
use MoonShine\Components\When;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Tab;
use MoonShine\Decorations\Tabs;
use MoonShine\Pages\Page;

class UserProfilePage extends Page
{
    protected string $layout = 'userprofile';
    protected string $title = 'Профиль';

    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title(),
        ];
    }

    public function components(): array
    {
        return [
            Block::make([
                Tabs::make([
                    Tab::make('information', [
                        FormBuilder::make(route('user-profile-information.update'))
                    ])
                ])
            ])
        ];
    }
}

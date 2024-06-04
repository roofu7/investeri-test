<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Users;

use App\MoonShine\Resources\PageResource;
use MoonShine\Components\Layout\Sidebar;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class UserAccount extends Page
{
    protected string $layout = 'moonshine::layouts.app';
    protected string $title = 'User Account';
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'User Account';
    }

    protected function menu(): array
    {
        return [];
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
		return [
//            Sidebar::make()
        ];
	}

    public function getAlias(): ?string
    {
        return 'user_account';
    }
}

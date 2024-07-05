<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Users;

use MoonShine\Components\MoonShineComponent;
use MoonShine\Pages\Page;

class UsersList extends Page
{
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
        return $this->title ?: 'UsersList';
    }

    /**
     * @return MoonShineComponent
     */
    public function components(): array
	{
		return [];
	}
}

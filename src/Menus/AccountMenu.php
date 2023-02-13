<?php

namespace TomatoPHP\TomatoCrm\Menus;

use TomatoPHP\TomatoPHP\Services\Menu\Menu;
use TomatoPHP\TomatoPHP\Services\Menu\TomatoMenu;

class AccountMenu extends TomatoMenu
{
    /**
     * @var ?string
     * @example ACL
     */
    public ?string $group = "Crm";

    /**
     * @var ?string
     * @example dashboard
     */
    public ?string $menu = "dashboard";

    public function __construct()
    {
        $this->group = __('Crm');
    }

    /**
     * @return array
     */
    public static function handler(): array
    {
        return [
            Menu::make()
                ->label(__("Accounts"))
                ->icon("bx bxs-user-circle")
                ->route("admin.accounts.index"),
            Menu::make()
                ->label(__("Contacts"))
                ->icon("bx bxs-phone")
                ->route("admin.contacts.index"),
        ];
    }
}

<?php

namespace TomatoPHP\TomatoCrm;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;
use TomatoPHP\TomatoCrm\Events\SendOTP;
use TomatoPHP\TomatoCrm\Menus\AccountMenu;
use TomatoPHP\TomatoCrm\Models\Account;
use TomatoPHP\TomatoCrm\Services\BuildAuth;
use TomatoPHP\TomatoCrm\Services\TomatoCRM;
use TomatoPHP\TomatoCrm\Supports\Action;
use TomatoPHP\TomatoCrm\Supports\Filter;
use TomatoPHP\TomatoNotifications\Services\SendNotification;
use TomatoPHP\TomatoPHP\Services\Menu\TomatoMenuRegister;


class TomatoCrmServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        require_once __DIR__ . '/../src/Helpers/action-filtes.php';

        //Register generate command
        $this->commands([
            \TomatoPHP\TomatoCrm\Console\TomatoCrmInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__ . '/../config/tomato-crm.php', 'tomato-crm');

        //Publish Config
        $this->publishes([
            __DIR__ . '/../config/tomato-crm.php' => config_path('tomato-crm.php'),
        ], 'tomato-crm-config');

        //Publish Model
        $this->publishes([
            __DIR__ . '/../publish/Account.php' => app_path('Models/Account.php'),
        ], 'tomato-crm-model');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        //Publish Migrations
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'tomato-crm-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tomato-crm');

        //Publish Views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/tomato-crm'),
        ], 'tomato-crm-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'tomato-crm');

        //Publish Lang
        $this->publishes([
            __DIR__ . '/../resources/lang' => app_path('lang/vendor/tomato-crm'),
        ], 'tomato-crm-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        $this->app->bind('tomato-auth', function () {
            return new BuildAuth();
        });

        $this->app->bind('tomato-crm', function () {
            return new TomatoCRM();
        });


        $this->app->singleton('core-action', function () {
            return new Action();
        });

        $this->app->singleton('core-filter', function () {
            return new Filter();
        });


    }

    public function boot(): void
    {
        $menus = [];
        if (config('tomato-crm.features.accounts')) {
            $menus[] = Menu::make()
                ->group(__('CRM'))
                ->label(__('Accounts'))
                ->route('admin.accounts.index')
                ->icon('bx bx-user');
        }
        if (config('tomato-crm.features.groups')) {
            $menus[] = Menu::make()
                ->group(__('CRM'))
                ->label(__('Groups'))
                ->route('admin.groups.index')
                ->icon('bx bx-group');
        }
        if (config('tomato-crm.features.locations')) {
            $menus[] = Menu::make()
                ->group(__('CRM'))
                ->label(__('Locations'))
                ->route('admin.locations.index')
                ->icon('bx bx-map');
        }
        if (config('tomato-crm.features.contacts')) {
            $menus[] = Menu::make()
                ->group(__('CRM'))
                ->label(__('Contact Us'))
                ->route('admin.contacts.index')
                ->icon('bx bx-phone');
        }
        if (config('tomato-crm.features.activites')) {
            $menus[] = Menu::make()
                ->group(__('CRM'))
                ->label(__('Activites'))
                ->route('admin.activities.index')
                ->icon('bx bx-history');
        }
        if (config('tomato-crm.features.notifications')) {
            $menus[] = Menu::make()
                ->group(__('CRM'))
                ->label(__('Send Notification'))
                ->route('admin.accounts.notifications.index')
                ->icon('bx bx-bell');
        }
        if (config('tomato-crm.features.send_otp')) {
            Event::listen([
                SendOTP::class
            ], function ($data) {
                $user = $data->model::find($data->modelId);

                SendNotification::make(['email'])
                    ->title('OTP')
                    ->message('Your OTP is ' . $user->otp_code)
                    ->type('info')
                    ->database(false)
                    ->model(Account::class)
                    ->id($user->id)
                    ->privacy('private')
                    ->icon('bx bx-user')
                    ->url(url('/'))
                    ->fire();
            });
        }

        TomatoMenu::register($menus);
    }
}

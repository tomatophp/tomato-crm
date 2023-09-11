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
use TomatoPHP\TomatoNotifications\Services\SendNotification;
use TomatoPHP\TomatoPHP\Services\Menu\TomatoMenuRegister;


class TomatoCrmServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\TomatoCrm\Console\TomatoCrmInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/tomato-crm.php', 'tomato-crm');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/tomato-crm.php' => config_path('tomato-crm.php'),
        ], 'tomato-crm-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'tomato-crm-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-crm');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-crm'),
        ], 'tomato-crm-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-crm');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => app_path('lang/vendor/tomato-crm'),
        ], 'tomato-crm-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->app->bind('tomato-auth',function(){
            return new BuildAuth();
        });
    }

    public function boot(): void
    {
        TomatoMenu::register([
            Menu::make()
                ->group(__('CRM'))
                ->label(__('Types'))
                ->route('admin.types.index')
                ->icon('bx bx-category'),
           Menu::make()
                ->group(__('CRM'))
                ->label(__('Accounts'))
                ->route('admin.accounts.index')
                ->icon('bx bx-user'),
            Menu::make()
                ->group(__('CRM'))
                ->label(__('Locations'))
                ->route('admin.locations.index')
                ->icon('bx bx-map'),
           Menu::make()
                ->group(__('CRM'))
                ->label(__('Groups'))
                ->route('admin.groups.index')
                ->icon('bx bx-group'),
            Menu::make()
                ->group(__('CRM'))
                ->label(__('Contact Us'))
                ->route('admin.contacts.index')
                ->icon('bx bx-phone'),
            Menu::make()
                ->group(__('CRM'))
                ->label(__('Activites'))
                ->route('admin.activities.index')
                ->icon('bx bx-history')
        ]);

        Event::listen([
            SendOTP::class
        ], function ($data) {
            $user = $data->model::find($data->modelId);

            SendNotification::make(['email'])
                ->title('OTP')
                ->message('Your OTP is '.$user->otp_code)
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
}

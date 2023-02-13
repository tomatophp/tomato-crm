<?php

namespace Tomatophp\TomatoCrm;

use Illuminate\Support\ServiceProvider;


class TomatoCrmServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \Tomatophp\TomatoCrm\Console\TomatoCrmInstall::class,
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
 
    }

    public function boot(): void
    {
        //you boot methods here
    }
}

<?php


use Illuminate\Support\Facades\Route;

if(config('tomato-crm.features.accounts')){
    Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/accounts', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'index'])->name('accounts.index');
        Route::get('admin/accounts/api', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'api'])->name('accounts.api');
        Route::get('admin/accounts/create', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'create'])->name('accounts.create');
        Route::get('admin/accounts/import', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'import'])->name('accounts.import');
        Route::post('admin/accounts/import', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'importStore'])->name('accounts.import.store');
        Route::get('admin/accounts/{model}/password', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'password'])->name('accounts.password');
        Route::post('admin/accounts/{model}/password', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'updatePassword'])->name('accounts.password.update');
        if(config('tomato-crm.features.notifications')) {
            Route::get('admin/accounts/notifications', [\TomatoPHP\TomatoCrm\Http\Controllers\NotificationsController::class, 'index'])->name('accounts.notifications.index');
            Route::get('admin/accounts/{model}/notifications', [\TomatoPHP\TomatoCrm\Http\Controllers\NotificationsController::class, 'user'])->name('accounts.notifications');
            Route::post('admin/accounts/notifications', [\TomatoPHP\TomatoCrm\Http\Controllers\NotificationsController::class, 'send'])->name('accounts.notifications.send');
        }
        if(config('tomato-crm.features.locations')) {
            Route::get('admin/accounts/{model}/address', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'addressView'])->name('accounts.address');
            Route::post('admin/accounts/{model}/address', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'address'])->name('accounts.address.add');
        }
        Route::post('admin/accounts', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'store'])->name('accounts.store');
        Route::get('admin/accounts/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'show'])->name('accounts.show');
        Route::get('admin/accounts/{model}/edit', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'edit'])->name('accounts.edit');
        Route::post('admin/accounts/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'update'])->name('accounts.update');
        Route::delete('admin/accounts/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\AccountController::class, 'destroy'])->name('accounts.destroy');
    });
}

if(config('tomato-crm.features.contacts')) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/contacts', [\TomatoPHP\TomatoCrm\Http\Controllers\ContactController::class, 'index'])->name('contacts.index');
        Route::get('admin/contacts/api', [\TomatoPHP\TomatoCrm\Http\Controllers\ContactController::class, 'api'])->name('contacts.api');
        Route::get('admin/contacts/create', [\TomatoPHP\TomatoCrm\Http\Controllers\ContactController::class, 'create'])->name('contacts.create');
        Route::post('admin/contacts', [\TomatoPHP\TomatoCrm\Http\Controllers\ContactController::class, 'store'])->name('contacts.store');
        Route::get('admin/contacts/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\ContactController::class, 'show'])->name('contacts.show');
        Route::get('admin/contacts/{model}/edit', [\TomatoPHP\TomatoCrm\Http\Controllers\ContactController::class, 'edit'])->name('contacts.edit');
        Route::post('admin/contacts/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\ContactController::class, 'update'])->name('contacts.update');
        Route::delete('admin/contacts/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\ContactController::class, 'destroy'])->name('contacts.destroy');
    });
}


if(config('tomato-crm.features.locations')) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/locations', [\TomatoPHP\TomatoCrm\Http\Controllers\LocationController::class, 'index'])->name('locations.index');
        Route::get('admin/locations/api', [\TomatoPHP\TomatoCrm\Http\Controllers\LocationController::class, 'api'])->name('locations.api');
        Route::get('admin/locations/create', [\TomatoPHP\TomatoCrm\Http\Controllers\LocationController::class, 'create'])->name('locations.create');
        Route::post('admin/locations', [\TomatoPHP\TomatoCrm\Http\Controllers\LocationController::class, 'store'])->name('locations.store');
        Route::get('admin/locations/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\LocationController::class, 'show'])->name('locations.show');
        Route::get('admin/locations/{model}/edit', [\TomatoPHP\TomatoCrm\Http\Controllers\LocationController::class, 'edit'])->name('locations.edit');
        Route::post('admin/locations/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\LocationController::class, 'update'])->name('locations.update');
        Route::delete('admin/locations/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\LocationController::class, 'destroy'])->name('locations.destroy');
    });
}

if(config('tomato-crm.features.activites')) {
    Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/activities', [\TomatoPHP\TomatoCrm\Http\Controllers\ActivityController::class, 'index'])->name('activities.index');
        Route::get('admin/activities/api', [\TomatoPHP\TomatoCrm\Http\Controllers\ActivityController::class, 'api'])->name('activities.api');
        Route::get('admin/activities/create', [\TomatoPHP\TomatoCrm\Http\Controllers\ActivityController::class, 'create'])->name('activities.create');
        Route::post('admin/activities', [\TomatoPHP\TomatoCrm\Http\Controllers\ActivityController::class, 'store'])->name('activities.store');
        Route::get('admin/activities/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\ActivityController::class, 'show'])->name('activities.show');
        Route::get('admin/activities/{model}/edit', [\TomatoPHP\TomatoCrm\Http\Controllers\ActivityController::class, 'edit'])->name('activities.edit');
        Route::post('admin/activities/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\ActivityController::class, 'update'])->name('activities.update');
        Route::delete('admin/activities/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\ActivityController::class, 'destroy'])->name('activities.destroy');
    });
}


if(config('tomato-crm.features.groups')) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/groups', [\TomatoPHP\TomatoCrm\Http\Controllers\GroupsController::class, 'index'])
            ->name('groups.index');
        Route::get('admin/groups/api', [\TomatoPHP\TomatoCrm\Http\Controllers\GroupsController::class, 'api'])->name('groups.api');
        Route::get('admin/groups/create', [\TomatoPHP\TomatoCrm\Http\Controllers\GroupsController::class, 'create'])->name('groups.create');
        Route::post('admin/groups', [\TomatoPHP\TomatoCrm\Http\Controllers\GroupsController::class, 'store'])->name('groups.store');
        Route::get('admin/groups/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\GroupsController::class, 'show'])->name('groups.show');
        Route::get('admin/groups/{model}/edit', [\TomatoPHP\TomatoCrm\Http\Controllers\GroupsController::class, 'edit'])->name('groups.edit');
        Route::post('admin/groups/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\GroupsController::class, 'update'])->name('groups.update');
        Route::delete('admin/groups/{model}', [\TomatoPHP\TomatoCrm\Http\Controllers\GroupsController::class, 'destroy'])->name('groups.destroy');
    });
}

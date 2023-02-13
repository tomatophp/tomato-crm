<?php

namespace TomatoPHP\TomatoCrm\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoCrm\Models\Account;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoPHP\Services\Tomato;

class AccountController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            view: 'tomato-crm::accounts.index',
            table: \TomatoPHP\TomatoCrm\Tables\AccountTable::class,
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: \TomatoPHP\TomatoCrm\Models\Account::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-crm::accounts.create',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\Account\AccountStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\TomatoPHP\TomatoCrm\Http\Requests\Account\AccountStoreRequest $request): RedirectResponse
    {
        $request->validated();

        if($request->get('loginBy') === 'email'){

        }
        $record = Account::create($request->all());

        Toast::title('Account created successfully')->success()->autoDismiss(2);
        return redirect()->route('admin.accounts.index');
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Account $model
     * @return View
     */
    public function show(\TomatoPHP\TomatoCrm\Models\Account $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::accounts.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Account $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoCrm\Models\Account $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::accounts.edit',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\Account\AccountUpdateRequest $request
     * @param \TomatoPHP\TomatoCrm\Models\Account $user
     * @return RedirectResponse
     */
    public function update(\TomatoPHP\TomatoCrm\Http\Requests\Account\AccountUpdateRequest $request, \TomatoPHP\TomatoCrm\Models\Account $model): RedirectResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Account updated successfully'),
            redirect: 'admin.accounts.index',
        );

        return $response['redirect'];
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Account $model
     * @return RedirectResponse
     */
    public function destroy(\TomatoPHP\TomatoCrm\Models\Account $model): RedirectResponse
    {
        return Tomato::destroy(
            model: $model,
            message: __('Account deleted successfully'),
            redirect: 'admin.accounts.index',
        );
    }
}

<?php

namespace TomatoPHP\TomatoCrm\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoPHP\Services\Tomato;

class AccountsMetaController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            view: 'tomato-crm::accounts-metas.index',
            table: \TomatoPHP\TomatoCrm\Tables\AccountsMetaTable::class,
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
            model: \TomatoPHP\TomatoCrm\Models\AccountsMeta::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-crm::accounts-metas.create',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\AccountsMeta\AccountsMetaStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\TomatoPHP\TomatoCrm\Http\Requests\AccountsMeta\AccountsMetaStoreRequest $request): RedirectResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \TomatoPHP\TomatoCrm\Models\AccountsMeta::class,
            message: __('AccountsMeta created successfully'),
            redirect: 'admin.accounts-metas.index',
        );

        return $response['redirect'];
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\AccountsMeta $model
     * @return View
     */
    public function show(\TomatoPHP\TomatoCrm\Models\AccountsMeta $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::accounts-metas.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\AccountsMeta $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoCrm\Models\AccountsMeta $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::accounts-metas.edit',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\AccountsMeta\AccountsMetaUpdateRequest $request
     * @param \TomatoPHP\TomatoCrm\Models\AccountsMeta $user
     * @return RedirectResponse
     */
    public function update(\TomatoPHP\TomatoCrm\Http\Requests\AccountsMeta\AccountsMetaUpdateRequest $request, \TomatoPHP\TomatoCrm\Models\AccountsMeta $model): RedirectResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('AccountsMeta updated successfully'),
            redirect: 'admin.accounts-metas.index',
        );

        return $response['redirect'];
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\AccountsMeta $model
     * @return RedirectResponse
     */
    public function destroy(\TomatoPHP\TomatoCrm\Models\AccountsMeta $model): RedirectResponse
    {
        return Tomato::destroy(
            model: $model,
            message: __('AccountsMeta deleted successfully'),
            redirect: 'admin.accounts-metas.index',
        );
    }
}

<?php

namespace TomatoPHP\TomatoCrm\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoPHP\Services\Tomato;

class ContactsMetaController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            view: 'tomato-crm::contacts-metas.index',
            table: \TomatoPHP\TomatoCrm\Tables\ContactsMetaTable::class,
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
            model: \TomatoPHP\TomatoCrm\Models\ContactsMeta::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-crm::contacts-metas.create',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\ContactsMeta\ContactsMetaStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\TomatoPHP\TomatoCrm\Http\Requests\ContactsMeta\ContactsMetaStoreRequest $request): RedirectResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \TomatoPHP\TomatoCrm\Models\ContactsMeta::class,
            message: __('ContactsMeta created successfully'),
            redirect: 'admin.contacts-metas.index',
        );

        return $response['redirect'];
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\ContactsMeta $model
     * @return View
     */
    public function show(\TomatoPHP\TomatoCrm\Models\ContactsMeta $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::contacts-metas.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\ContactsMeta $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoCrm\Models\ContactsMeta $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::contacts-metas.edit',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\ContactsMeta\ContactsMetaUpdateRequest $request
     * @param \TomatoPHP\TomatoCrm\Models\ContactsMeta $user
     * @return RedirectResponse
     */
    public function update(\TomatoPHP\TomatoCrm\Http\Requests\ContactsMeta\ContactsMetaUpdateRequest $request, \TomatoPHP\TomatoCrm\Models\ContactsMeta $model): RedirectResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('ContactsMeta updated successfully'),
            redirect: 'admin.contacts-metas.index',
        );

        return $response['redirect'];
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\ContactsMeta $model
     * @return RedirectResponse
     */
    public function destroy(\TomatoPHP\TomatoCrm\Models\ContactsMeta $model): RedirectResponse
    {
        return Tomato::destroy(
            model: $model,
            message: __('ContactsMeta deleted successfully'),
            redirect: 'admin.contacts-metas.index',
        );
    }
}

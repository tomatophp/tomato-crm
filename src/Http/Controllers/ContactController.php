<?php

namespace TomatoPHP\TomatoCrm\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoPHP\Services\Tomato;

class ContactController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            view: 'tomato-crm::contacts.index',
            table: \TomatoPHP\TomatoCrm\Tables\ContactTable::class,
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
            model: \TomatoPHP\TomatoCrm\Models\Contact::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-crm::contacts.create',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\Contact\ContactStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\TomatoPHP\TomatoCrm\Http\Requests\Contact\ContactStoreRequest $request): RedirectResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \TomatoPHP\TomatoCrm\Models\Contact::class,
            message: __('Contact created successfully'),
            redirect: 'admin.contacts.index',
        );

        return $response['redirect'];
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Contact $model
     * @return View
     */
    public function show(\TomatoPHP\TomatoCrm\Models\Contact $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::contacts.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Contact $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoCrm\Models\Contact $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::contacts.edit',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\Contact\ContactUpdateRequest $request
     * @param \TomatoPHP\TomatoCrm\Models\Contact $user
     * @return RedirectResponse
     */
    public function update(\TomatoPHP\TomatoCrm\Http\Requests\Contact\ContactUpdateRequest $request, \TomatoPHP\TomatoCrm\Models\Contact $model): RedirectResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Contact updated successfully'),
            redirect: 'admin.contacts.index',
        );

        return $response['redirect'];
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Contact $model
     * @return RedirectResponse
     */
    public function destroy(\TomatoPHP\TomatoCrm\Models\Contact $model): RedirectResponse
    {
        return Tomato::destroy(
            model: $model,
            message: __('Contact deleted successfully'),
            redirect: 'admin.contacts.index',
        );
    }
}

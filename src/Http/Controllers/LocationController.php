<?php

namespace TomatoPHP\TomatoCrm\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoPHP\Services\Tomato;

class LocationController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            view: 'tomato-crm::locations.index',
            table: \TomatoPHP\TomatoCrm\Tables\LocationTable::class,
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
            model: \TomatoPHP\TomatoCrm\Models\Location::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-crm::locations.create',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\Location\LocationStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\TomatoPHP\TomatoCrm\Http\Requests\Location\LocationStoreRequest $request): RedirectResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \TomatoPHP\TomatoCrm\Models\Location::class,
            message: __('Location created successfully'),
            redirect: 'admin.locations.index',
        );

        return $response['redirect'];
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Location $model
     * @return View
     */
    public function show(\TomatoPHP\TomatoCrm\Models\Location $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::locations.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Location $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoCrm\Models\Location $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::locations.edit',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\Location\LocationUpdateRequest $request
     * @param \TomatoPHP\TomatoCrm\Models\Location $user
     * @return RedirectResponse
     */
    public function update(\TomatoPHP\TomatoCrm\Http\Requests\Location\LocationUpdateRequest $request, \TomatoPHP\TomatoCrm\Models\Location $model): RedirectResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Location updated successfully'),
            redirect: 'admin.locations.index',
        );

        return $response['redirect'];
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Location $model
     * @return RedirectResponse
     */
    public function destroy(\TomatoPHP\TomatoCrm\Models\Location $model): RedirectResponse
    {
        return Tomato::destroy(
            model: $model,
            message: __('Location deleted successfully'),
            redirect: 'admin.locations.index',
        );
    }
}

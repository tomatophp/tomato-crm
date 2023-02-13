<?php

namespace TomatoPHP\TomatoCrm\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoPHP\Services\Tomato;

class ActivityController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            view: 'tomato-crm::activities.index',
            table: \TomatoPHP\TomatoCrm\Tables\ActivityTable::class,
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
            model: \TomatoPHP\TomatoCrm\Models\Activity::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-crm::activities.create',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\Activity\ActivityStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\TomatoPHP\TomatoCrm\Http\Requests\Activity\ActivityStoreRequest $request): RedirectResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \TomatoPHP\TomatoCrm\Models\Activity::class,
            message: __('Activity created successfully'),
            redirect: 'admin.activities.index',
        );

        return $response['redirect'];
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Activity $model
     * @return View
     */
    public function show(\TomatoPHP\TomatoCrm\Models\Activity $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::activities.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Activity $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoCrm\Models\Activity $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::activities.edit',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\Activity\ActivityUpdateRequest $request
     * @param \TomatoPHP\TomatoCrm\Models\Activity $user
     * @return RedirectResponse
     */
    public function update(\TomatoPHP\TomatoCrm\Http\Requests\Activity\ActivityUpdateRequest $request, \TomatoPHP\TomatoCrm\Models\Activity $model): RedirectResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Activity updated successfully'),
            redirect: 'admin.activities.index',
        );

        return $response['redirect'];
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Activity $model
     * @return RedirectResponse
     */
    public function destroy(\TomatoPHP\TomatoCrm\Models\Activity $model): RedirectResponse
    {
        return Tomato::destroy(
            model: $model,
            message: __('Activity deleted successfully'),
            redirect: 'admin.activities.index',
        );
    }
}

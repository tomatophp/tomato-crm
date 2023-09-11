<?php

namespace TomatoPHP\TomatoCrm\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use TomatoPHP\TomatoCrm\Models\Account;
use TomatoPHP\TomatoCrm\Models\Group;
use TomatoPHP\TomatoCrm\Http\Requests\Group\GroupStoreRequest;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class GroupsController extends Controller
{

    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            model: Group::class,
            view: 'tomato-crm::groups.index',
            table: \TomatoPHP\TomatoCrm\Tables\GroupTable::class,
        );
    }


    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: Group::class,
        );
    }


    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-crm::groups.create'
        );
    }


    public function store(GroupStoreRequest $request): RedirectResponse
    {
        $response = Tomato::store(
            request: $request,
            model: Group::class,
            message: __('Group created successfully'),
            redirect: 'admin.groups.index',
        );

        return back();
    }


    public function show(Group $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::groups.show',
        );
    }


    public function edit(Group $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::groups.edit'
        );
    }


    public function update(GroupStoreRequest $request, Group $model): RedirectResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Group updated successfully'),
            redirect: 'admin.groups.index',
        );

        return back();
    }


    public function destroy(Group $model)
    {
        return Tomato::destroy(
            model: $model,
            message: __('Group deleted successfully'),
            redirect: 'admin.groups.index',
        );
    }
}

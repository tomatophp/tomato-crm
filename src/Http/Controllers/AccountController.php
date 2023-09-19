<?php

namespace TomatoPHP\TomatoCrm\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use TomatoPHP\TomatoCrm\Models\Account;
use TomatoPHP\TomatoCrm\Models\Group;

class AccountController extends Controller
{
    private string $loginBy = 'email';

    /**
     * @param $loginBy
     */
    public function __construct()
    {
        $this->loginBy = config('tomato-crm.login_by');
    }


    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Account::query();
        if ($request->get('type') && !empty($request->get('type'))) {
            $query->where('type', $request->get('type'));
        }
        if ($request->get('group_id') && !empty($request->get('group_id'))) {
            $query->whereHas('groups', function ($q) use ($request) {
                $q->where('group_id', $request->get('group_id'));
            });
        }
        $filters = \TomatoPHP\TomatoCrm\Facades\TomatoCrm::getFilters();
        $setFiltersArray = [];
        foreach ($filters as $item) {
            if (Schema::hasColumn('accounts', $item)) {
                $setFiltersArray[$item] = $item;
            } else {
                if ($request->has($item) && !empty($request->has($item))) {
                    $query->whereHas('accountsMetas', function ($q) use ($item, $request) {
                        $q->where('key', $item)->where('value', $request->get($item));
                    });
                }
            }
        }
        return Tomato::index(
            request: $request,
            model: Account::class,
            view: 'tomato-crm::accounts.index',
            table: \TomatoPHP\TomatoCrm\Tables\AccountTable::class,
            query: $query,
            filters: $setFiltersArray,
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
        $data = [];
        $data['types'] = \TomatoPHP\TomatoCategory\Models\Type::where('for', 'accounts')->where('type', 'type')->get();
        if(config('tomato-crm.features.groups')){
            $data['groups'] = Group::all();
        }
        return Tomato::create(
            view: 'tomato-crm::accounts.create',
            data: $data,
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\Account\AccountStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\TomatoPHP\TomatoCrm\Http\Requests\Account\AccountStoreRequest $request): RedirectResponse|JsonResponse
    {
        $request->validated();

        if ($this->loginBy === 'email') {
            $checkUsername = Account::where('username', $request->get('email'))->first();
            if ($checkUsername) {
                Toast::title('Sorry This Email is Exists')->danger()->autoDismiss(2);
                return back();
            }

            $request->merge(['username' => $request->get('email')]);
        }
        if ($this->loginBy === 'phone') {
            $checkUsername = Account::where('username', $request->get('phone'))->first();
            if ($checkUsername) {
                Toast::title('Sorry This Phone is Exists')->danger()->autoDismiss(2);
                return back();
            }
            $request->merge(['username' => $request->get('phone')]);
        }

        $request->merge([
            "password" => bcrypt($request->get('password'))
        ]);

        $response = Tomato::store(
            request: $request,
            model: \TomatoPHP\TomatoCrm\Models\Account::class,
            message: __('Account created successfully'),
            redirect: 'admin.accounts.index',
            hasMedia: \TomatoPHP\TomatoCrm\Facades\TomatoCrm::isHasMedia(),
            collection: \TomatoPHP\TomatoCrm\Facades\TomatoCrm::getMedia(),
        );

        foreach (\TomatoPHP\TomatoCrm\Facades\TomatoCrm::getAttachedItems() as $key => $item) {
            if ($request->has($key) && !empty($request->get($key))) {
                $response->record->meta($key, $request->get($key));
            }
        }

        if(config('tomato-crm.features.groups')){
            if($request->has('groups') && count($request->get('groups'))){
                $response->record->groups()->attach(array_values($request->get('groups')));
            }
        }

        return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Account $model
     * @return View
     */
    public function show(\TomatoPHP\TomatoCrm\Models\Account $model): View|JsonResponse
    {
        $model->email = $model->meta('email');
        $model->phone = $model->meta('phone');
        foreach (\TomatoPHP\TomatoCrm\Facades\TomatoCrm::getShow() as $key => $item) {
            $model->{$key} = $model->meta($key);
        }
        if(config('tomato-crm.features.groups')){
            $model->groups = $model->groups()->pluck('group_id')->toArray();
        }
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
        foreach (\TomatoPHP\TomatoCrm\Facades\TomatoCrm::getShow() as $key => $item) {
            $model->{$key} = $model->meta($key);
        }
        if(config('tomato-crm.features.groups')){
            $model->groups = $model->groups()->pluck('group_id')->toArray();
        }
        $data = [];
        $data['types'] = \TomatoPHP\TomatoCategory\Models\Type::where('for', 'accounts')->where('type', 'type')->get();
        if(config('tomato-crm.features.groups')){
            $data['groups'] = Group::all();
        }
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::accounts.edit',
            data: $data,
            hasMedia: \TomatoPHP\TomatoCrm\Facades\TomatoCrm::isHasMedia(),
            collection: \TomatoPHP\TomatoCrm\Facades\TomatoCrm::getMedia(),
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\Account\AccountUpdateRequest $request
     * @param \TomatoPHP\TomatoCrm\Models\Account $user
     * @return RedirectResponse
     */
    public function update(\TomatoPHP\TomatoCrm\Http\Requests\Account\AccountUpdateRequest $request, \TomatoPHP\TomatoCrm\Models\Account $model): RedirectResponse|JsonResponse
    {
        if ($this->loginBy === 'email') {
            $checkUsername = Account::where('username', $request->get('email'))->where('id', '!=', $model->id)->first();
            if ($checkUsername) {
                Toast::title('Sorry This Email is Exists')->danger()->autoDismiss(2);
                return back();
            }

            $request->merge(['username' => $request->get('email')]);
        }
        if ($this->loginBy === 'phone') {
            $checkUsername = Account::where('username', $request->get('phone'))->where('id', '!=', $model->id)->first();
            if ($checkUsername) {
                Toast::title('Sorry This Phone is Exists')->danger()->autoDismiss(2);
                return back();
            }
            $request->merge(['username' => $request->get('phone')]);
        }

        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Account updated successfully'),
            redirect: 'admin.accounts.index',
            hasMedia: \TomatoPHP\TomatoCrm\Facades\TomatoCrm::isHasMedia(),
            collection: \TomatoPHP\TomatoCrm\Facades\TomatoCrm::getMedia(),
        );

        foreach (\TomatoPHP\TomatoCrm\Facades\TomatoCrm::getAttachedItems() as $key => $item) {
            if ($request->has($key) && !empty($request->get($key))) {
                $response->record->meta($key, $request->get($key));
            }
        }

        if(config('tomato-crm.features.groups')){
            $response->record->groups()->sync($request->get('groups') ? array_values($request->get('groups')) : []);
        }

        return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Account $model
     * @return RedirectResponse
     */
    public function destroy(\TomatoPHP\TomatoCrm\Models\Account $model): RedirectResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Account deleted successfully'),
            redirect: 'admin.accounts.index',
        );

        return $response->redirect;
    }


    public function password(Account $model)
    {
        return view('tomato-crm::accounts.password', [
            "model" => $model
        ]);
    }

    public function updatePassword(Request $request, Account $model)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $model->update([
            "password" => bcrypt($request->get('password'))
        ]);

        Toast::success(__('Password Updated Successfully'))->autoDismiss(2);
        return redirect()->back();
    }
}

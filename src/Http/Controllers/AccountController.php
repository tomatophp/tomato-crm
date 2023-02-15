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
            data: [
                'types' => \TomatoPHP\TomatoCategory\Models\Type::where('for', 'accounts')->get(),
            ],
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
            $checkUsername = Account::where('username', $request->get('email'))->first();
            if($checkUsername){
                Toast::title('Sorry This Email is Exists')->danger()->autoDismiss(2);
                return back();
            }

            $request->merge(['username' => $request->get('email')]);
        }
        if($request->get('loginBy') === 'phone'){
            $checkUsername = Account::where('username', $request->get('phone'))->first();
            if($checkUsername){
                Toast::title('Sorry This Phone is Exists')->danger()->autoDismiss(2);
                return back();
            }
            $request->merge(['username' => $request->get('phone')]);
        }

        $record = Account::create($request->all());

        $record->meta('email', $request->get('email'));
        $record->meta('phone', $request->get('phone'));

        Toast::title('Account created successfully')->success()->autoDismiss(2);
        return redirect()->route('admin.accounts.index');
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\Account $model
     * @return View
     */
    public function show(\TomatoPHP\TomatoCrm\Models\Account $model): View
    {
        $model->email = $model->meta('email');
        $model->phone = $model->meta('phone');
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
        $model->email = $model->meta('email');
        $model->phone = $model->meta('phone');
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::accounts.edit',
            data: [
                'types' => \TomatoPHP\TomatoCategory\Models\Type::where('for', 'accounts')->get(),
            ],
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Http\Requests\Account\AccountUpdateRequest $request
     * @param \TomatoPHP\TomatoCrm\Models\Account $user
     * @return RedirectResponse
     */
    public function update(\TomatoPHP\TomatoCrm\Http\Requests\Account\AccountUpdateRequest $request, \TomatoPHP\TomatoCrm\Models\Account $model): RedirectResponse
    {
        if($request->get('loginBy') === 'email'){
            $checkUsername = Account::where('username', $request->get('email'))->where('id', '!=', $model->id)->first();
            if($checkUsername){
                Toast::title('Sorry This Email is Exists')->danger()->autoDismiss(2);
                return back();
            }

            $request->merge(['username' => $request->get('email')]);
        }
        if($request->get('loginBy') === 'phone'){
            $checkUsername = Account::where('username', $request->get('phone'))->where('id', '!=', $model->id)->first();
            if($checkUsername){
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
        );

        $response['record']->meta('email', $request->get('email'));
        $response['record']->meta('phone', $request->get('phone'));

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

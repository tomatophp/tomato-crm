<?php

namespace TomatoPHP\TomatoCrm\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use TomatoPHP\TomatoCrm\Models\AccountRequest;
use TomatoPHP\TomatoCrm\Models\AccountRequestMeta;

class AccountRequestController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \TomatoPHP\TomatoCrm\Models\AccountRequest::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-crm::account-requests.index',
            table: \TomatoPHP\TomatoCrm\Tables\AccountRequestTable::class
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
            model: \TomatoPHP\TomatoCrm\Models\AccountRequest::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-crm::account-requests.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \TomatoPHP\TomatoCrm\Models\AccountRequest::class,
            validation: [
                'account_id' => 'required|exists:accounts,id',
                'user_id' => 'nullable|exists:users,id',
                'type' => 'nullable|max:255|string',
                'status' => 'nullable|max:255|string',
                'is_approved' => 'nullable'
            ],
            message: __('AccountRequest updated successfully'),
            redirect: 'admin.account-requests.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\AccountRequest $model
     * @return View|JsonResponse
     */
    public function show(\TomatoPHP\TomatoCrm\Models\AccountRequest $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::account-requests.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\AccountRequest $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoCrm\Models\AccountRequest $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-crm::account-requests.edit',
        );
    }

    /**
     * @param Request $request
     * @param \TomatoPHP\TomatoCrm\Models\AccountRequest $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \TomatoPHP\TomatoCrm\Models\AccountRequest $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'account_id' => 'sometimes|exists:accounts,id',
                'user_id' => 'nullable|exists:users,id',
                'type' => 'nullable|max:255|string',
                'status' => 'nullable|max:255|string',
                'is_approved' => 'nullable'
            ],
            message: __('AccountRequest updated successfully'),
            redirect: 'admin.account-requests.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoCrm\Models\AccountRequest $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\TomatoPHP\TomatoCrm\Models\AccountRequest $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('AccountRequest deleted successfully'),
            redirect: 'admin.account-requests.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    public function approve(AccountRequestMeta $model)
    {
        $model->update([
            "is_approved" => true,
            "is_approved_at" => now(),
            "is_rejected" => false,
            "is_rejected_at" => null,
            "rejected_reason" => null,
        ]);

        $request = $model->accountRequest;
        $hasPending = false;
        foreach ($request->accountRequestMetas as $meta){
            if(!$meta->is_approved){
                $hasPending = true;
            }
        }

        if(!$hasPending){
            $request->update([
                "user_id" => auth('web')->user()->id,
                "status" => "approved",
                "is_approved" => true,
                "is_approved_at" => now(),
            ]);

            $request->account->type = 'vendor';
            $request->account->save();

            foreach ($request->accountRequestMetas as $meta){
                if($meta->key === 'image'){
                    $request->account->meta($meta->key, $meta->getMedia('image')->first()?->getUrl());
                }
                else {
                    $request->account->meta($meta->key, $meta->value);
                }
            }
        }

        Toast::success(__('Account request approvied successfully'))->autoDismiss(2);
        return redirect()->back();
    }

    public function reject(AccountRequestMeta $model, Request $request)
    {
        $request->validate([
            "rejected_reason" => "required|string"
        ]);

        $model->update([
            "is_rejected" => true,
            "is_rejected_at" => now(),
            "rejected_reason" => $request->get("rejected_reason"),
        ]);

        $model->accountRequest->update([
            "user_id" => auth('web')->user()->id,
            "status" => "rejected"
        ]);

        Toast::success(__('Account request rejected successfully'))->autoDismiss(2);
        return redirect()->back();
    }

    public function approveAll(AccountRequest $model)
    {
        foreach ($model->accountRequestMetas as $meta){
            $meta->is_approved = true;
            $meta->is_approved_at = now();
            $meta->is_rejected = false;
            $meta->is_rejected_at = null;
            $meta->rejected_reason = null;
            $meta->save();


            $model->account->type = 'vendor';
            $model->account->save();

            foreach ($model->accountRequestMetas as $meta){
                if($meta->key === 'image'){
                    $model->account->meta($meta->key, $meta->getMedia('image')->first()?->getUrl());
                }
                else {
                    $model->account->meta($meta->key, $meta->value);
                }
            }
        }

        $model->user_id = auth('web')->user()->id;
        $model->status = "approved";
        $model->is_approved = true;
        $model->save();

        Toast::success(__('Account request approvied successfully'))->autoDismiss(2);
        return redirect()->back();
    }
}

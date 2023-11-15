<?php

namespace TomatoPHP\TomatoCrm\Services\Traits\Auth;

use Carbon\Carbon;
use TomatoPHP\TomatoAdmin\Helpers\ApiResponse;
use TomatoPHP\TomatoCrm\Events\SendOTP;
use TomatoPHP\TomatoCrm\Helpers\Response;
use TomatoPHP\TomatoCrm\Services\Contracts\WebResponse;

trait Otp
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function otp(\Illuminate\Http\Request $request,string $type="api"): \Illuminate\Http\JsonResponse|WebResponse
    {
        $request->validate([
            $this->loginBy => 'required|string|max:255',
            'otp_code' => 'required|string|max:6',
        ]);

        $user = app($this->model)->where("username", $request->get($this->loginBy))->first();

        if ($user) {
            if ((!empty($user->otp_code)) && ($user->otp_code === $request->get('otp_code'))) {
                $user->otp_activated_at = Carbon::now();
                $user->otp_code = null;
                $user->is_active = true;
                $user->save();

                if($type === 'api'){
                    return ApiResponse::success(__('your Account has been activated'));
                }
                else {
                    return WebResponse::make(__('your Account has been activated'))->success();
                }

            }

            if($type === 'api'){
                return ApiResponse::errors(__('sorry this code is not valid or expired'));
            }
            else {
                return WebResponse::make(__('sorry this code is not valid or expired'));
            }


        }

        if($type === 'api') {
            return ApiResponse::errors(__('user not found'), 404);
        }
        else {
            return WebResponse::make(__('user not found'));
        }
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resend(\Illuminate\Http\Request $request,string $type="api"): \Illuminate\Http\JsonResponse|WebResponse
    {
        $request->validate([
            $this->loginBy => "required|exists:".app($this->model)->getTable().",username",
        ]);

        $checkIfActive = $this->model::where("username", $request->get($this->loginBy))->whereNotNull('otp_activated_at')->first();
        if ($checkIfActive) {
            if($type === 'api') {
                return ApiResponse::errors(__('Your Account is already activated'));
            }
            else {
                return WebResponse::make(__('Your Account is already activated'));
            }
        }

        $checkIfEx = $this->model::where("username", $request->get($this->loginBy))->first();
        $checkIfEx->otp_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $checkIfEx->save();

        SendOTP::dispatch($this->model, $checkIfEx->id);

        if($type === 'api'){
            return ApiResponse::success(__('An OTP Has been send to your ').$this->loginType . __(' please check it'));
        }
        else {
            return WebResponse::make(__('An OTP Has been send to your ').$this->loginType . __(' please check it'))->success();
        }
    }
}

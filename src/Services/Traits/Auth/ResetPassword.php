<?php

namespace TomatoPHP\TomatoCrm\Services\Traits\Auth;

use Carbon\Carbon;
use TomatoPHP\TomatoAdmin\Helpers\ApiResponse;
use TomatoPHP\TomatoCrm\Events\SendOTP;
use TomatoPHP\TomatoCRM\Helpers\Response;

trait ResetPassword
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            $this->loginBy => "required|exists:".app($this->model)->getTable().",username",
        ]);

        $checkIfActive = $this->model::where("username", $request->get($this->loginBy))->first();
        if ($checkIfActive) {
            $checkIfActive->otp_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $checkIfActive->save();

            SendOTP::dispatch($this->model, $checkIfActive->id);

            return ApiResponse::success('An OTP Has been send to your '.$this->loginType . ' please check it');
        }

        return ApiResponse::errors(__('user not found'), 404);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function password(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $request->user();

        if($user){
            $request->validate([
                'password' => "required|confirmed|min:6|max:191",
            ]);

            $user->password = bcrypt($request->get('password'));
            $user->save();

            return ApiResponse::success("Password Updated");
        }
        else {
            $request->validate([
                'password' => "required|confirmed|min:6|max:191",
                'otp_code' => 'required|string|max:6|exists:'.app($this->model)->getTable().',otp_code',
                $this->loginBy => 'required|string|max:255|exists:'.app($this->model)->getTable().',username',
            ]);

            $user = app($this->model)->where("username", $request->get($this->loginBy))->first();

            if ($user) {
                if ((!empty($user->otp_code)) && ($user->otp_code === $request->get('otp_code'))) {
                    $user->otp_activated_at = Carbon::now();
                    $user->otp_code = null;
                    $user->password = bcrypt($request->get('password'));
                    $user->save();

                    return ApiResponse::success("Password Updated");
                }

                return ApiResponse::errors(__('sorry this code is not valid or expired'));
            }

            return ApiResponse::errors(__('user not found'), 404);
        }
    }
}

<?php

namespace TomatoPHP\TomatoCrm\Services\Traits\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use TomatoPHP\TomatoAdmin\Helpers\ApiResponse;

trait Login
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(\Illuminate\Http\Request $request): Model|JsonResponse
    {
        $check = auth($this->guard)->attempt([
            "username" => $request->get($this->loginBy),
            "password" => $request->get('password')
        ]);

        if($check){
            $user = auth($this->guard)->user();
            if($user->is_active && $this->otp){
                $token = $user->createToken($this->guard)->plainTextToken;
                $user->token = $token;
                return $user;
            }
            else if(!$user->is_active && $this->otp){
                return ApiResponse::errors(__("Your account is not active yet"));
            }
            else if(!$this->otp) {
                $token = $user->createToken($this->guard)->plainTextToken;
                $user->token = $token;
                if($this->resource){
                    $user = $this->resource::make($user);
                }
                return ApiResponse::data($user, __('Login Success'));
            }
        }

        return ApiResponse::errors(__("Username Or Password Is Not Correct"));
    }
}

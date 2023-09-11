<?php

namespace TomatoPHP\TomatoCrm\Services\Traits\Auth;

use TomatoPHP\TomatoAdmin\Helpers\ApiResponse;
use TomatoPHP\TomatoCrm\Events\SendOTP;
use TomatoPHP\TomatoCrm\Helpers\Response;

trait Register
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(\Illuminate\Http\Request $request, array $validation=[], ?string $resource): \Illuminate\Http\JsonResponse
    {
        $request->validate(
            array_merge([
                "password" => "required|confirmed|min:6|max:191"
            ], $this->createValidation, $validation)
        );

        $data = $request->all();

        if($this->loginBy === 'phone'){
            $data['username'] = $request->get('phone');
        }
        elseif($this->loginBy === 'email'){
            $data['username'] = $request->get('email');
        }

        $data['password'] = bcrypt($request->get('password'));

        $user = app($this->model)->create($data);

        if ($user) {
            //Set More Data to Meta
            foreach ($request->all() as $key => $value) {
                if (!in_array($key, ['password', 'password_confirmation', 'username', 'name'])) {
                    $user->meta($key, $value);
                }
            }
            if($this->otp){
                $user->otp_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
                $user->save();

                SendOTP::dispatch($this->model, $user->id);
                AccountRegistered::dispatch($this->model, $user->id);

                return ApiResponse::success('An OTP Has been send to your '.$this->loginType . ' please check it');
            }

            $token = $user->createToken($this->guard)->plainTextToken;
            $user->token = $token;

            AccountRegistered::dispatch($this->model, $user->id);
            if($resource){
                $user = $resource::make($user);
            }
            return ApiResponse::data($user, __('User registration success'));
        }

        return ApiResponse::errors('User registration failed');
    }

}

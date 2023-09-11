<?php

namespace TomatoPHP\TomatoCrm\Http\Controllers\APIs;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Js;
use TomatoPHP\TomatoCrm\Facades\TomatoAuth;
use TomatoPHP\TomatoCrm\Models\Account;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        TomatoAuth::guard('accounts');
        TomatoAuth::requiredOtp(true);
        TomatoAuth::loginBy('phone');
        TomatoAuth::loginType('phone');
        TomatoAuth::model(Account::class);
    }

    public function login(Request $request): JsonResponse
    {
        return TomatoAuth::login($request);
    }

    public function register(Request $request): JsonResponse
    {
        return TomatoAuth::register(
            request: $request,
            validation: [
                "name" => "required|string|max:255",
                "phone" => "required|string|max:255|unique:accounts,username",
                "email" => "required|string|max:255|unique:accounts,username",
            ]
        );
    }

    public function resend(Request $request): JsonResponse
    {
        return TomatoAuth::resend($request);
    }

    public function otp(Request $request){
        return TomatoAuth::otp($request);
    }

    public function reset(Request $request): JsonResponse
    {
        return TomatoAuth::reset($request);
    }

    public function password(Request $request): JsonResponse
    {
        return TomatoAuth::password($request);
    }
}

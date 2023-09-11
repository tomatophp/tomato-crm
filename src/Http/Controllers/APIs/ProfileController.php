<?php

namespace TomatoPHP\TomatoCrm\Http\Controllers\APIs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TomatoPHP\TomatoCrm\Facades\TomatoAuth;
use TomatoPHP\TomatoCrm\Models\Account;

class ProfileController extends Controller
{
    public function __construct()
    {
        TomatoAuth::guard('accounts');
        TomatoAuth::requiredOtp(true);
        TomatoAuth::loginBy('phone');
        TomatoAuth::loginType('phone');
        TomatoAuth::model(Account::class);
    }

    public function profile(Request $request){
       return TomatoAuth::profile($request);
    }

    public function update(Request $request){
        return TomatoAuth::update($request, [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:accounts,username',
            'phone' => 'sometimes|string|max:255|unique:accounts,username',
            'birthday' => 'sometimes|string|max:255',
            'gender' => 'sometimes|string|max:255',
        ]);
    }

    public function password(Request $request){
        return TomatoAuth::password($request);
    }

    public function logout(Request $request){
        return TomatoAuth::logout($request);
    }

    public function destroy(Request $request){
        return TomatoAuth::destroy($request);
    }
}

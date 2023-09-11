<?php

namespace TomatoPHP\TomatoCrm\Facades;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

/**
 * @method static guard(string $guard)
 * @method static requiredOtp(bool $otp)
 * @method static model(string $model)
 * @method static loginBy(string $loginBy)
 * @method static loginType(string $loginType)
 * @method static validation(array $validation)
 * @method \Illuminate\Http\JsonResponse login(\Illuminate\Http\Request $request, ?string $resource=null)
 * @method \Illuminate\Http\JsonResponse otp(\Illuminate\Http\Request $request)
 * @method \Illuminate\Http\JsonResponse register(\Illuminate\Http\Request $request, array $validation=[])
 * @method \Illuminate\Http\JsonResponse reset(\Illuminate\Http\Request $request)
 * @method \Illuminate\Http\JsonResponse password(\Illuminate\Http\Request $request)
 * @method \Illuminate\Http\JsonResponse resend(\Illuminate\Http\Request $request)
 * @method \Illuminate\Http\JsonResponse profile(\Illuminate\Http\Request $request, ?string $resource=null)
 */
class TomatoAuth extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'tomato-auth';
    }
}

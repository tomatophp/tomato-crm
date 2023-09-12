<?php

namespace TomatoPHP\TomatoCrm\Services\Traits\Profile;

use TomatoPHP\TomatoAdmin\Helpers\ApiResponse;
use TomatoPHP\TomatoCRM\Helpers\Response;

trait User
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $request->user();
        if($this->resource){
            $user = $this->resource::make($user);
        }
        return ApiResponse::data($user, __("Profile Data Load"));
    }
}

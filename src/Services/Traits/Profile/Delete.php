<?php

namespace TomatoPHP\TomatoCrm\Services\Traits\Profile;

use TomatoPHP\TomatoAdmin\Helpers\ApiResponse;
use TomatoPHP\TomatoCRM\Helpers\Response;

trait Delete
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $request->user();
        $this->model::where("username", $user->username)->delete();
        return ApiResponse::success('Account Has Been Deleted');
    }
}

<?php

namespace TomatoPHP\TomatoCrm\Services\Traits\Profile;

use TomatoPHP\TomatoAdmin\Helpers\ApiResponse;
use TomatoPHP\TomatoCRM\Helpers\Response;
use TomatoPHP\TomatoCrm\Services\Contracts\WebResponse;

trait Delete
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(\Illuminate\Http\Request $request,string $type="api"): \Illuminate\Http\JsonResponse|WebResponse
    {
        $user = $request->user();
        $this->model::where("username", $user->username)->delete();

        if($type === 'api'){
            return ApiResponse::success(__('Account Has Been Deleted'));
        }
        else {
            return WebResponse::make(__('Account Has Been Deleted'))->success();
        }

    }
}

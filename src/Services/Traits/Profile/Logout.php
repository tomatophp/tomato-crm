<?php

namespace TomatoPHP\TomatoCrm\Services\Traits\Profile;

use TomatoPHP\TomatoCRM\Helpers\Response;

trait Logout
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        auth($this->guard)->logout();

        $user = $this->model::find($request->user()->id);
        $user->tokens()->delete();

        return Response::success("Logout Success");
    }
}

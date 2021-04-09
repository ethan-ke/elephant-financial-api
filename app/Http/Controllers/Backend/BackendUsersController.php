<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BackendUsersController extends MainController
{

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return custom_response($this->user());
    }
}

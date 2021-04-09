<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class AuthorizationsController extends AccessTokenController
{
    /**
     * @param ServerRequestInterface $request
     * @return Response
     */
    public function store(ServerRequestInterface $request): Response
    {
        return $this->issueToken($request)->setStatusCode(201);
    }

    /**
     * @param ServerRequestInterface $request
     * @return Response
     */
    public function update(ServerRequestInterface $request): Response
    {
        return $this->issueToken($request);
    }

    /**
     * @return JsonResponse
     */
    public function destroy(): JsonResponse
    {
        Auth::logout();
        return custom_response(status_code: 204);
    }
}

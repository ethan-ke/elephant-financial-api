<?php

namespace App\Http\Controllers;

use App\Models\BackendUser;
use App\Models\FrontendUser;
use Auth;
use EasyWeChat;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * @var int $perPage Per Page.
     */
    public $perPage;

    /**
     * @var string $guard
     */
    public $guard;

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->guard = $request->get('guard');
        Auth()->shouldUse($this->guard);
        $this->perPage = $request->limit ?? 15;
    }

    /**
     * @return Authenticatable|BackendUser|FrontendUser
     */
    public function user(): BackendUser|FrontendUser
    {
        return Auth::user();
    }

    /**
     * @param string $token
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return custom_response([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'expires_in'   => Auth::factory()->getTTL() * 60,
        ], status_code: 201);
    }

    /**
     * @return EasyWeChat\OfficialAccount\Application
     */
    public function officialAccount(): EasyWeChat\OfficialAccount\Application
    {
        return EasyWeChat::officialAccount();
    }
}

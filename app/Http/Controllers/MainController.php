<?php

namespace App\Http\Controllers;

use App\Models\BackendUser;
use App\Models\Staff;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * @var int $perPage Per Page.
     */
    public $perPage;

    /**
     * Controller constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        Auth()->shouldUse('backend');
        $this->perPage = $request->limit ?? 15;
    }

    /**
     * @return BackendUser|Staff
     */
    public function user(): BackendUser|Staff
    {
        return Auth::user();
    }
}

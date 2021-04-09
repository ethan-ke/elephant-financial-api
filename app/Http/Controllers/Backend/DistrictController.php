<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $item = District::get();
        return custom_response($item);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate(['name' => 'required']);
        District::create($validated);
        return custom_response(message: 10101);
    }

    /**
     * Display the specified resource.
     *
     * @param District $district
     * @return JsonResponse
     */
    public function show(District $district): JsonResponse
    {
        return custom_response($district);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param District $district
     * @return JsonResponse
     */
    public function update(Request $request, District $district): JsonResponse
    {
        $validated = $request->validate(['name' => 'required']);
        $district->update($validated);
        return custom_response(message: '10103');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param District $district
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(District $district): JsonResponse
    {
        $district->delete();
        return custom_response(status_code: 204);
    }
}

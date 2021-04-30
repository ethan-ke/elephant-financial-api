<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): JsonResponse
    {
        $item = Staff::with('district')->get();
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
        $validated = $request->validate([
            'name' => 'required',
            'district_id' => 'required',
        ]);
        Staff::create($validated);
        return custom_response(message: 10101);
    }


    /**
     * Display the specified resource.
     *
     * @param Staff $staff
     * @return JsonResponse
     */
    public function show(Staff $staff): JsonResponse
    {
        return custom_response($staff);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Staff $staff
     * @return JsonResponse
     */
    public function update(Request $request, Staff $staff): JsonResponse
    {
        $validated = $request->validate(['name' => 'required']);
        $staff->update($validated);
        return custom_response(message: '10103');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Staff $staff
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Staff $staff): JsonResponse
    {
        $staff->delete();
        return custom_response(status_code: 204);
    }
}

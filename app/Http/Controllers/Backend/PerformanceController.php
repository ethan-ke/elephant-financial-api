<?php

namespace App\Http\Controllers\Backend;

use App\Exports\Backend\PerformanceExport;
use App\Http\Controllers\MainController;
use App\Http\Requests\Backend\PerformanceRequest;
use App\Http\Resources\PerformanceResource;
use App\Models\Performance;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\QueryBuilder;
use Storage;

class PerformanceController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $item = QueryBuilder::for(Performance::class)->with('staff')->orderBy('staff_id')->paginate();
        return custom_response(PerformanceResource::collection($item)->response()->getData());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PerformanceRequest $request
     * @return JsonResponse
     */
    public function store(PerformanceRequest $request): JsonResponse
    {
        $validated = $request->validated();
        switch ((int) $validated['status']) {
            case Performance::STATUS_PENDING:
                $validated['pending']  = Performance::PENDING;
                break;
            case Performance::STATUS_START:
                $validated['start']  = Performance::START;
                break;
        }
        Performance::create($validated);
        return custom_response(message: 10101);
    }

    /**
     * Display the specified resource.
     *
     * @param Performance $performance
     * @return JsonResponse
     */
    public function show(Performance $performance): JsonResponse
    {
        return custom_response($performance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Performance $performance
     * @return JsonResponse
     */
    public function update(PerformanceRequest $request, Performance $performance): JsonResponse
    {
        $validated = $request->validateD();

        switch ((int) $validated['status']) {
            case Performance::STATUS_PENDING:
                $validated['pending']  = Performance::PENDING;
                $validated['start']  = null;
                break;
            case Performance::STATUS_START:
                $validated['pending'] = null;
                $validated['start']  = Performance::START;
                break;
        }
        $performance->update($validated);
        return custom_response(message: '10103');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Performance $performance
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Performance $performance): JsonResponse
    {
        $performance->delete();
        return custom_response(status_code: 204);
    }

    /**
     * @return JsonResponse
     */
    public function export(): JsonResponse
    {
        $path = 'public/excel/performance.xlsx';
        Excel::store(new PerformanceExport(), $path);
        return custom_response(['url' => env('APP_URL') . Storage::url('excel/performance.xlsx')]);
    }
}

<?php

namespace App\Exports\Backend;

use App\Http\Resources\PerformanceResource;
use App\Models\Performance;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PerformanceExport implements FromCollection, WithEvents
{
    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        $data = Performance::with('staff')->orderBy('staff_id')->get();
        $item = PerformanceResource::collection($data)->response()->getData()->data;
        $header = ['姓名', '单价', '人数', '提成率', '未开班', '已开班', '金额', '合计', '备注'];
        $finally = (new Collection($item))->map(function ($item) {
            unset($item->id);
            return $item;
        })->toArray();

        return new Collection(array_merge([$header], $finally));
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $collection = $this->collection();
                $collection->shift();
                $items = $collection->groupBy('staff_name', true)->values();
//                dd($items);
                for ($i = 0; $i < $items->count(); $i++) {
//                    if ()
                    $event->sheet->getDelegate()->mergeCells('A2:A4');
                    dd($items[$i]);
                }
//                dd();
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(30);
                $event->sheet->getDelegate()->mergeCells('A2:A4');
                $event->sheet->getDelegate()->mergeCells('A5:A6');
                $event->sheet->getDelegate()->getStyle('A2:A4')->getAlignment()->setVertical('center');
//                dd($this->collection());
            }
        ];
    }
}

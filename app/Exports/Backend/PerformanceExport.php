<?php

namespace App\Exports\Backend;

use App\Http\Resources\PerformanceResource;
use App\Models\Performance;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PerformanceExport implements FromCollection, WithEvents
{
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        $data = Performance::with('staff')->orderBy('staff_id')->get();
        $item = PerformanceResource::collection($data)->response()->getData()->data;
        $header = [
            '姓名',
            '单价',
            '人数',
            '提成率',
            '未开班',
            '已开班',
            '金额',
            '合计',
            '备注',
        ];
        $finally = (new Collection($item))->map(function ($item) {
            $remark = $item->remark;
            unset($item->id);
            unset($item->remark);
            $item->amount = null;
            $item->remark = $remark;
            return $item;
        })->toArray();
        return new Collection(array_merge([$header], $finally));
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $collection = $this->collection();
                $collection->shift();
                $items = $collection->groupBy('staff_name', true)->values();
                $line_number = [];
                for ($i = 0; $i < $items->count(); $i++) {
                    if ($i > 0) {
                        $key = $i - 1;
                        $end_line = $line_number[$key] + $items[$i]->count();
                        $line_number[$i] = $end_line;
                        $start_line = $line_number[$key] + 1;
                    } else {
                        $end_line = 2 + $items[$i]->count() - 1;
                        $line_number[$i] = $end_line;
                        $start_line = 2;
                    }
                    $cell_total = $items[$i]->sum(fn($item) => $item->salary);
                    $name_range = 'A' . $start_line . ':A' . $end_line;
                    $total_range = 'H' . $start_line . ':H' . $end_line;
                    $number_range = 'C' . $start_line . ':C' . $end_line;
                    $event->sheet->getDelegate()->mergeCells($name_range);
                    $event->sheet->getDelegate()->getStyle($name_range)->getAlignment()->setVertical('center');

                    $event->sheet->getDelegate()->mergeCells($total_range);
                    $event->sheet->getDelegate()->getStyle($total_range)->getAlignment()->setVertical('center');
                    $event->sheet->getDelegate()->setCellValue('H' . $start_line, $cell_total);

                    $event->sheet->getDelegate()->getStyle($number_range)->getFont()->getColor()->setARGB('FFFF0000');
                }
                $end_line = array_pop($line_number);
                $event->sheet->styleCells(
                    'A1:I' . $end_line,
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_MEDIUM,
                                'color' => ['argb' => '000000'],
                            ],
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                        ],
                    ]
                );
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(30);
            }
        ];
    }
}

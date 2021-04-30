<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PerformanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $salary = (float)match ($this->resource->status) {
            1 => $this->resource->price * $this->resource->number * $this->resource->commission_rate * $this->resource->pending,
            2 => $this->resource->price * $this->resource->number * $this->resource->commission_rate * $this->resource->start,
        };
        return [
            'id'              => $this->resource->id,
            'staff_name'      => $this->resource->staff->name,
            'price'           => $this->resource->price,
            'number'          => $this->resource->number,
            'commission_rate' => $this->resource->commission_rate,
            'pending'         => $this->resource->pending,
            'start'           => $this->resource->start,
            'salary'          => sprintf("%.2f", $salary),
            'remark'          => $this->resource->remark,
        ];
    }
}

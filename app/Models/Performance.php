<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Performance
 *
 * @property int $id
 * @property int $user_id
 * @property string $price
 * @property int $number
 * @property string $commission_rate
 * @property int $status 1: 未开班, 2: 已开班
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Performance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Performance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Performance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Performance whereCommissionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Performance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Performance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Performance whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Performance wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Performance whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Performance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Performance whereUserId($value)
 * @mixin \Eloquent
 */
class Performance extends Model
{
    use HasFactory;
}

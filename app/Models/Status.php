<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;


/**
 * App\Models\Status
 *
 * @Status
 * @package App\Models
 * @property integer $id
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection|Order[] $orders
 * @property-read int|null $orders_count
 *
 * @method static Builder|Status newModelQuery()
 * @method static Builder|Status newQuery()
 * @method static Builder|Status query()
 * @method static Builder|Status whereCreatedAt($value)
 * @method static Builder|Status whereId($value)
 * @method static Builder|Status whereStatus($value)
 * @method static Builder|Status whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */

class Status extends Model
{
    use HasFactory;

    /**
     * @var array[]
     */

   protected $table = 'status';

    protected $fillable = [
        'status',
    ];

    /**
     * @return HasMany
     */

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'status_id', 'id');
    }




}

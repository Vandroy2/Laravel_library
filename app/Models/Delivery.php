<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;


/**
 * App\Models\Delivery
 *
 * @Delivery
 * @package App\Models
 * @property string $delivery_name
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read int|null $cities_count
 * @property-read Collection|Office[] $offices
 * @property-read int|null $offices_count
 * @property-read Collection|Order[] $orders
 * @property-read int|null $orders_count
 * @property-read Collection|City[] $cities
 *
 * @method static Builder|Delivery newModelQuery()
 * @method static Builder|Delivery newQuery()
 * @method static Builder|Delivery query()
 * @method static Builder|Delivery whereCreatedAt($value)
 * @method static Builder|Delivery whereDeliveryName($value)
 * @method static Builder|Delivery whereId($value)
 * @method static Builder|Delivery whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */

class Delivery extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $table = 'deliveries';

    protected $fillable = [
        'delivery_name',

    ];

    /**
     * @return HasMany
     */

    public function offices(): HasMany
    {
        return $this->hasMany(Office::class, 'delivery_id', 'id');
    }

    /**
     * @return HasMany
     */

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'delivery_id', 'id');
    }

    /**
     * @return BelongsToMany
     */

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class);
    }
}

<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;


/**
 * class City
 *
 * @package App\Models
 * @property int $id
 * @property string $city_name

 * @property-read Collection|Delivery[] $deliveries
 * @property-read int|null $deliveries_count
 * @property-read Collection|Library[] $libraries
 * @property-read int|null $libraries_count
 * @property-read Collection|Order[] $orders
 * @property-read int|null $orders_count
 *
 * @method static Builder|City newModelQuery()
 * @method static Builder|City newQuery()
 * @method static Builder|City query()
 * @method static Builder|City whereCityName($value)
 * @method static Builder|City whereId($value)
 *
 * @mixin Eloquent
 */

class City extends Model
{
    public $timestamps = false;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array[]
     */

    protected $fillable = [
        'city_name',
    ];

    /**
     * @return HasMany
     */

    public function libraries(): HasMany
    {

        return $this->hasMany(Library::class, 'city_id', 'id');
    }

    /**
     * @return belongsToMany
     */

    public function deliveries(): BelongsToMany
    {
        return $this->belongsToMany(Delivery::class);
    }

    /**
     * @return HasMany
     */

    public function orders(): hasmany
    {
        return $this->hasMany(Order::class,'city_id', 'id');
    }
}

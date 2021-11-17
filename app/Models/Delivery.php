<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use phpDocumentor\Reflection\Types\Collection;

/**
 * @Delivery
 *
 * @package App\Models
 *
 * @property string $delivery_name
 *
 * @property Office[]| Collection $offices
 * @property Order[]| Collection $orders
 * @property City[]|Collection $cities
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

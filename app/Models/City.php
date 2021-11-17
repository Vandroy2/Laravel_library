<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Collection\Collection;

/**
 * class City
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $city_name
 *
 * @property library[]| Collection $library
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

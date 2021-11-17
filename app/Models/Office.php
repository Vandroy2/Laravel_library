<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @Office
 *
 * @property integer $office_number
 * @property integer $delivery_id
 *
 * @property Delivery $deliveries
 */

class Office extends Model
{
    use HasFactory;

    protected $table = 'offices';

    protected $fillable = [
        'office_number',
        'delivery_id',
    ];

    /**
     * @return HasMany
     */

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'office_id', 'id');
    }


    /**
     * @return BelongsTo
     */

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class, 'delivery_id', 'id');
    }

    /**
     * @return BelongsTo
     */

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    /**
     * @return string
     */

    public function getOfficenameAttribute(): string
    {

        return " №{$this->office_number} адрес отделения {$this->deliveries->delivery_name}";
    }



}

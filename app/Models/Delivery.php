<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @Delivery
 *
 * @package App\Models
 *
 * @property string $name
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
     * @var mixed
     */


    /**
     * @return HasMany
     */

    public function offices(): HasMany
    {
        return $this->hasMany(Office::class, 'delivery_id', 'id');
    }

    /**
     * @return BelongsTo
     */

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'delivery_id', 'id');
    }



}

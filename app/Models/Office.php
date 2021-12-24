<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

/**
 * App\Models\Office

 * @property integer $office_number
 * @property integer $delivery_id
 * @property Delivery $deliveries
 * @property int $id
 * @property int|null $city_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read City|null $city
 * @property-read Delivery|null $delivery
 * @property-read string $officename
 * @property-read Collection|Order[] $orders
 * @property-read int|null $orders_count
 *
 * @method static Builder|Office newModelQuery()
 * @method static Builder|Office newQuery()
 * @method static Builder|Office query()
 * @method static Builder|Office whereCityId($value)
 * @method static Builder|Office whereCreatedAt($value)
 * @method static Builder|Office whereDeliveryId($value)
 * @method static Builder|Office whereId($value)
 * @method static Builder|Office whereOfficeNumber($value)
 * @method static Builder|Office whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */

class Office extends Model
{
    use HasFactory;

    /**
     * @var string
     */

    protected $table = 'offices';

    /**
     * @var array[]
     */

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
        return " №$this->office_number адрес отделения {$this->deliveries->delivery_name}";
    }



}

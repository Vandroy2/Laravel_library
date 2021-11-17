<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OrderModel Order
 *
 * @package App\Models
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $status_id
 * @property integer $delivery_id
 * @property integer $city_id
 * @property integer $office_id
 * @property integer $order_comment
 *
 *
 * @property User $user
 * @property Book[]|Collection $books
 * @property Status $status
 * @property Delivery $delivery
 * @property City $city
 * @property Book_Order[]|Collection $orderBooks
 */
class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    /**
     * @var array[]
     */

    protected $fillable =
        [
            'user_id',
            'status_id',
            'delivery_id',
            'city_id',
            'office_id',
            'order_comment',
        ];
    /**
     * @var mixed
     */


    /**
     * @return BelongsTo
     */

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    /**
     * @return BelongsTo
     */

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    /**
     * @return BelongsTo
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
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
     * @return HasMany
     */
    public function orderBooks(): HasMany
    {
        return $this->hasMany(Book_Order::class, 'order_id', 'id');
    }
}

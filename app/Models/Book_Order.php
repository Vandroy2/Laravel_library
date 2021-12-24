<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Book_Order
 *
 * @property int $book_id
 * @property int $order_id
 * @property int $book_number
 * @property Book $book
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Book_Order newModelQuery()
 * @method static Builder|Book_Order newQuery()
 * @method static Builder|Book_Order query()
 * @method static Builder|Book_Order whereBookId($value)
 * @method static Builder|Book_Order whereBookNumber($value)
 * @method static Builder|Book_Order whereCreatedAt($value)
 * @method static Builder|Book_Order whereId($value)
 * @method static Builder|Book_Order whereOrderId($value)
 * @method static Builder|Book_Order whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Book_Order extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'book_order';

    /**
     * @var string[]
     */
    protected $fillable = [
        'book_id',
        'order_id',
        'book_number'
    ];

    /**
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }


}

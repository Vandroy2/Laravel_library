<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $book_id
 * @property int $order_id
 * @property int $book_number
 *
 * @property Book $book
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book() {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
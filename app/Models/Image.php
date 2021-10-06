<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * class Image
 *
 * @package App\Models
 *
 * @property integer $id
 * @property string $images
 * @property integer $user_id
 * @property integer $book_id
 *
 * @property Book $book
 * @property User $user
 */

class Image extends Model
{
    use HasFactory;

    /**
     * @var array
     */

    protected $fillable = [
        'id',
        'images',
        'user_id',
        'book_id',
    ];

    /**
     * @return BelongsTo
     *
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }


}

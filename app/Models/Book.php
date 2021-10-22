<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use mysql_xdevapi\Collection;

/**
 * @Book
 *
 * @package App\Models
 *
 * @property integer $id
 * @property string $book_name
 * @property integer $books_limit
 * @property integer $books_number
 * @property Carbon $num_pages
 * @property Carbon $created_date
 * @property integer $author_id
 * @property integer $library_id
 * @property integer $favorite
 *
 * @property Author
 * @property Library
 * @property Image |Collection $images
 * @property User |Collection $users
 * @property Order|Collection $orders
 */
class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array[]
     */

    protected $table = 'books';

    protected $fillable=[

        'id',
        'book_name',
        'books_limit',
        'books_number',
        'num_pages',
        'created_date',
        'author_id',
        'library_id',
        'favorite',

    ];
    /**
     * @var mixed
     */
    private $books_number;

    /**
     * @var int|mixed
     */

    /**
     * @return BelongsTo
     */


    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    /**
     * @return BelongsTo
     */

    public function library(): BelongsTo
    {
        return $this->belongsTo(Library::class, 'library_id', 'id');
    }

    /**
     * @return HasMany
     */

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'book_id', 'id');
    }

    /**
     * @return BelongsToMany
     */

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * @param $value
     * @return string
     */

    public function getFromDateAttribute($value): string
    {
        return \Carbon\Carbon::parse($value)->format('Y');
    }

    /**
     * @return BelongsToMany
     */

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withTimestamps();
    }
}





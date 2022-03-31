<?php

namespace App\Models;


use App\Models\Scope\BookScope;
use App\Services\Actions\BookActionService;
use App\Services\Actions\UserActionService;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;



/**
 * App\Models\Book
 *
 * @Book
 * @package App\Models
 * @property integer $id
 * @property string $book_name
 * @property integer $books_limit
 * @property integer $books_number
 * @property Carbon $num_pages
 * @property Carbon $created_date
 * @property integer $author_id
 * @property integer $library_id
 * @property integer $favorite
 * @property int|null $genre_id
 * @property string $price
 * @property string $type
 * @property string $file
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Author $author
 * @property-read Library $library
 * @property-read Collection|User[] $usersInBasket
 * @property-read Collection|User[] $users
 * @property-read Collection|Image[] $images
 * @property-read Collection|Order[] $orders
 * @property-read Sale|null $sale
 * @property-read Collection|Selection[] $selections
 * @property-read Collection|User $purchasedUsers
 * @property-read Genre|null $genre
 * @property-read string $from_date
 * @property-read int|null $images_count
 * @property-read int|null $orders_count
 * @property-read int|null $users_count
 * @property-read int|null $users_in_basket_count
 *
 * @method static Builder|Book newModelQuery()
 * @method static Builder|Book newQuery()
 * @method static Builder|Book query()
 * @method static Builder|Book whereAuthorId($value)
 * @method static Builder|Book whereBookName($value)
 * @method static Builder|Book whereBooksLimit($value)
 * @method static Builder|Book whereBooksNumber($value)
 * @method static Builder|Book whereCreatedAt($value)
 * @method static Builder|Book whereCreatedDate($value)
 * @method static Builder|Book whereGenreId($value)
 * @method static Builder|Book whereId($value)
 * @method static Builder|Book whereLibraryId($value)
 * @method static Builder|Book whereNumPages($value)
 * @method static Builder|Book wherePrice($value)
 * @method static Builder|Book whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Book extends Model
{
    use HasFactory;

    use BookScope;


    /**
     * The attributes that are mass assignable.
     *
     * @var array[]
     */

    protected $table = 'books';

    protected $fillable=[

        'id',
        'book_name',
        'genre_id',
        'books_limit',
        'books_number',
        'num_pages',
        'created_date',
        'author_id',
        'library_id',
        'favorite',
        'price',
        'type',
        'file',


    ];
    /**
     * @var mixed
     */
    private $books_number;

    /**
     * @var int|mixed
     */

    public $inCart;

//    public static function booksSubscribeAuthors(array $getAuthorsId)
//    {
//        return self::query()->whereIn('au');
//    }



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

    public function usersInBasket(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'baskets', 'book_id', 'user_id');
    }

    /**
     * @return BelongsTo
     */

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }

    /**
     * @return BelongsTo
     */

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'book_id', 'id');
    }

    public function bookOrder(): BelongsTo
    {
        return $this->belongsTo(Book_Order::class, 'book_id', 'id');
    }

    /**
     * @return BelongsToMany
     *
     */
    public function bookSelections(): BelongsToMany
    {
        return $this->belongsToMany(Selection::class);
    }

    /**
     * @return BelongsToMany
     */

    public function purchasedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'purchasedbooks', 'book_id', 'user_id');
    }

    /**
     * @return bool
     */

    public function subscribed(): bool
    {
        return BookActionService::fetchSubscribeBooks($this);
    }



}





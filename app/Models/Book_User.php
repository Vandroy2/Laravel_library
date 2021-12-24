<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Book_User
 *
 * @Book_User
 * @property integer $user_id
 * @property integer $book_id
 * @property string $favorite_book_name
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Book_User newModelQuery()
 * @method static Builder|Book_User newQuery()
 * @method static Builder|Book_User query()
 * @method static Builder|Book_User whereBookId($value)
 * @method static Builder|Book_User whereCreatedAt($value)
 * @method static Builder|Book_User whereFavoriteBookName($value)
 * @method static Builder|Book_User whereId($value)
 * @method static Builder|Book_User whereUpdatedAt($value)
 * @method static Builder|Book_User whereUserId($value)
 *
 * @mixin Eloquent
 */

class Book_User extends Model
{
    use HasFactory;
    protected $table = 'book_user';

    protected $fillable =
        [
            'user_id',
            'book_id',
            'favorite_book_name',
        ];
}

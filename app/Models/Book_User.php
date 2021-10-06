<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @Book_User
 *
 * @property integer $user_id
 * @property integer $book_id
 * @property string $favorite_book_name
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

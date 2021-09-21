<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @Book
 *
 * @package App\Models
 *
 * @property integer $id
 * @property string $book_name
 * @property Carbon $num_pages
 * @property Carbon $created_date
 * @property integer $author_id
 * @property integer $library_id
 *
 * @property Author
 * @property Library
 */
class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array[]
     */

    protected $fillable=[
        'book_name',
        'num_pages',
        'created_date',
        'author_id',
        'library_id',

    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function library(): BelongsTo
    {
        return $this->belongsTo(Library::class, 'library_id', 'id');
    }

    public function getFromDateAttribute($value): string
    {
        return \Carbon\Carbon::parse($value)->format('Y');
    }
}





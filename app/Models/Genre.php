<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * App\Models\Genre
 *
 * @package App\Models
 * @Genre Genre
 * @property integer $id
 * @property integer $genre_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection|Book[] $books
 * @property-read int|null $books_count
 *
 * @method static Builder|Genre newModelQuery()
 * @method static Builder|Genre newQuery()
 * @method static Builder|Genre query()
 * @method static Builder|Genre whereCreatedAt($value)
 * @method static Builder|Genre whereGenreName($value)
 * @method static Builder|Genre whereId($value)
 * @method static Builder|Genre whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_name',
    ];

    /**
     *
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * @return HasOne
     */

    public function image():HasOne
    {
        return $this->hasOne(Image::class);
    }

    /**
     * @return BelongsToMany
     */

    public function selections(): BelongsToMany
    {
        return $this->belongsToMany(Selection::class);
    }

    /**
     * @return BelongsToMany
     */

    public function subscribes(): BelongsToMany
    {
        return $this->belongsToMany(Subscribe::class);
    }


}

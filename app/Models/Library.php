<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

/**
 * class Library
 *
 * @package App\Models
 * @property integer $id
 * @property string $library_name
 * @property integer city_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property-read Collection|Book[] $books
 * @property-read int|null $books_count
 * @property-read City $city
 *
 * @method static Builder|Library newModelQuery()
 * @method static Builder|Library newQuery()
 * @method static Builder|Library query()
 * @method static Builder|Library whereCityId($value)
 * @method static Builder|Library whereCreatedAt($value)
 * @method static Builder|Library whereId($value)
 * @method static Builder|Library whereLibraryName($value)
 * @method static Builder|Library whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */

class Library extends Model
{
    public $timestamps = false;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array[]
     */

    protected $fillable = [
        'library_name',
        'city_id',
    ];

    /**
     * @return BelongsTo
     */

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    /**
    * @return hasMany
    */

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }


}

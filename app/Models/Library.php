<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * class Library
 *
 * @package App\Models
 *
 * @property integer $id
 * @property string $library_name
 * @property integer city_id
 *
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
        return $this->hasMany(Book::class,);
    }


}

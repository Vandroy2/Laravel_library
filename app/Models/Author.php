<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Support\Carbon;

use Ramsey\Collection\Collection;

/**
 * * Class Author
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $author_name
 * @property string $author_surname
 * @property Carbon $birthday
 * @property Carbon $death_day
 *
 * @property Book[]|Collection $books
 */
class Author extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array[]
     */

    protected $fillable=[
        'author_name',
        'author_surname',
        'birthday',
        'death_day',

    ];

    /**
     * @return HasMany
     */

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }

    /**
     *
     * @return string
     */
    public function getAgeAttribute(): string
    {
        if (!empty($this->death_day)) {
            return  $this->birthday->age - $this->death_day->age;
        } else return $this->birthday->age;
    }


    /**
     * @var string[]
     */
    protected $dates = ['birthday', 'death_day'];

    public function getFullnameAttribute()
    {
        return "{$this->author_name} {$this->author_surname}";
    }

}











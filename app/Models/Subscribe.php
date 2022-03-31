<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @package App/Models
 * @Subscribe Subscribe
 *
 * @property integer $id
 * @property string $subscribe_alias
 * @property string $subscribe_type
 * @property integer $subscribe_price
 * @property integer $monthQuantity
 * @property Carbon $dateStart
 * @property Carbon $dateEnd
 * @property integer $canceled
 *
 * @property-read Collection|User[] $users
 * @property-read Collection|Author[] $authors
 * @property-read Collection|Genre[] $genres
 */


class Subscribe extends Model
{
    use HasFactory;

    /**
     * @var array
     */

    protected $fillable = [

        'subscribe_alias',
        'subscribe_type',
        'subscribe_price',
        'monthQuantity',
        'dateStart',
        'dateEnd',
        'canceled',

    ];

    protected $dates =
        [
            'dateStart',
            'dateEnd',
        ];

    /**
     * @return string
     */

    public function getDurationAttribute(): string
    {
        return "{$this->monthQuantity} month";
    }

    /**
     * @return BelongsToMany
     */

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsToMany
     */

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * @return BelongsToMany
     */

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }



}

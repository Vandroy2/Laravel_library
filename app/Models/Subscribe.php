<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @package App/Models
 * @Subscribe Subscribe
 *
 * @property string $subscribe_type
 * @property integer $subscribe_price
 * @property integer $monthQuantity
 *
 * @property-read Collection|User[] $users
 */


class Subscribe extends Model
{
    use HasFactory;

    /**
     * @var array
     */

    protected $guarded = [];

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

}

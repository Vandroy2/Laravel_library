<?php

namespace App\Models;


use App\Services\Helpers\SubscribeHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @package App\Models
 * @ListOfSubscribe
 *
 * @property integer $id
 * @property string $alias
 * @property string $listSubscribeType
 * @property integer $listSubscribePrice
 * @property integer $listSubscribeMonthQuantity
 *
 * @property-read Collection|User[] $users
 */

class ListOfSubscribe extends Model
{
    use HasFactory;

    protected $table = 'listOfSubscribes';

    protected $fillable = [

        'alias',
        'listSubscribeType',
        'ListSubscribePrice',
        'listSubscribeMonthQuantity',


    ];

    /**
     * @return BelongsToMany
     */

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'listOfSubscribe_user', 'listOfSubscribe_id', 'user_id')->withPivot('listOfSubscribes');
    }

    public function getDurationAttribute(): string
    {
        return "{$this->listSubscribeMonthQuantity} month";
    }

    /**
     * @return bool
     */

    public function checkAffiliation(): bool
    {
        return SubscribeHelper::checkBelongsToSubscribe($this);
    }
}

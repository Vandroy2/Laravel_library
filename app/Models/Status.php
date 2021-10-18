<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use mysql_xdevapi\Collection;

/**
 * @Status
 *
 * @package App\Models
 *
 * @property integer $id
 * @property string $status
 * @property Order |Collection $orders
 *
 *
 */

class Status extends Model
{
    use HasFactory;

    /**
     * @var array[]
     */

   protected $table = 'status';

    protected $fillable = [
        'status',
    ];

    /**
     * @return HasMany
     */

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'status_id', 'id');
    }




}

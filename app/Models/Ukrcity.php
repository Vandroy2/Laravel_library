<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @Ukrcity
 *
 * @property string $name
 */

class Ukrcity extends Model
{
    use HasFactory;

    protected $table = 'ukrcities';

    /**
     * @var
     */
    protected $fillable = [
        'ukrcity_name',
    ];

    /**
     * @return HasMany
     */

    public function orders(): hasmany
    {
        return $this->hasMany(Order::class,'ukrcity_id', 'id');
    }
}

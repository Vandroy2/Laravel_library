<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return BelongsTo
     */

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class,'ukrcity_id', 'id');
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Sale
 *
 * @package App\Models
 * @Sale Sale
 * @property integer $id
 * @property integer $book_id
 * @property integer $count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Book $book
 *
 * @method static Builder|Sale newModelQuery()
 * @method static Builder|Sale newQuery()
 * @method static Builder|Sale query()
 * @method static Builder|Sale whereBookId($value)
 * @method static Builder|Sale whereCount($value)
 * @method static Builder|Sale whereCreatedAt($value)
 * @method static Builder|Sale whereId($value)
 * @method static Builder|Sale whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */

class Sale extends Model
{
    use HasFactory;

    /**
     * @var array[]
     */

    protected $fillable = [
        'book_id',
        'count',
    ];

    /**
     * @return string
     */

    public function date(): string
    {
        $date= $this->updated_at;
        $date = Carbon::parse($date);
        return $date->format('d.m.Y');
    }

    /**
     * @return BelongsTo
     */

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}


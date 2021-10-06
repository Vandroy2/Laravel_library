<?php

namespace App\Models;

use Faker\Provider\pt_BR\Text;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @Book
 *
 * @package App\Models
 *
 * @property integer $id
 * @property text $comment_text
 * @property Carbon $comment_created_at
 * @property integer $user_id
 * @property integer $published

 *
 * @property User $user
 *
 */

class Comment extends Model
{
    use HasFactory;

    const published = '1';
    const notPublished = 'null';

    /**
     * The attributes that are mass assignable.
     *
     * @var array[]
     */

    protected $fillable=[
        'comment_text',
        'comment_created_at',
        'user_id',
        'published',



    ];


    /**
     * @return belongsto
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}

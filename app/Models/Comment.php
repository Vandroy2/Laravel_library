<?php

namespace App\Models;

use Eloquent;
use Faker\Provider\pt_BR\Text;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Comment
 *
 * @Book
 * @package App\Models
 * @property integer $id
 * @property text $comment_text
 * @property Carbon $comment_created_at
 * @property integer $user_id
 * @property integer $published
 * @property User $user
 * @property string $comment_image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereCommentImage($value)
 * @method static Builder|Comment whereCommentText($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment wherePublished($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @method static Builder|Comment whereUserId($value)
 *
 * @mixin Eloquent
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

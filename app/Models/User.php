<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Class User
 *
 * @package App\Models
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property Carbon $birthday
 * @property integer $banned
 * @property integer $cart_number
 * @property integer $balance

 * @property Carbon|null $email_verified_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection|Book[] $books
 * @property-read int|null $books_count
 * @property-read Collection|Book[] $booksInBasket
 * @property-read int|null $books_in_basket_count
 * @property-read Collection|Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read Collection|Image[] $images
 * @property-read int|null $images_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 *
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereBanned($value)
 * @method static Builder|User whereBirthday($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereSurname($value)
 * @method static Builder|User whereType($value)
 * @method static Builder|User whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const SUPER_ADMIN = 'super_admin';
    const ADMIN = 'admin';
    const CLIENT = 'client';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type',
        'name',
        'surname',
        'email',
        'birthday',
        'banned',
        'cart_number',
        'balance',
        'subscribe_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'type' => 'string',
        'name' => 'string',
        'surname' => 'string',
        'email' => 'string',
        'birthday' => 'integer',
        'banned' => 'integer',
        'cart_number' => 'integer',
        'balance' => 'integer'

    ];
    /**
     * @var mixed
     */
    private $images;

    /**
     * @param  User $user
     *
     * @return bool
     */
    public function isHigherPosition(User $user): bool {
        switch($this->type) {
            case self::SUPER_ADMIN:
                return $user->type != self::SUPER_ADMIN;

            case self::ADMIN:
                return $user->type == self::CLIENT;
        }

        return false;
    }

    /**
     * @return hasMany
     */

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class,'user_id', 'id');
    }

    /**
     * @return BelongsToMany
     */

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */

    public function booksInBasket(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'baskets', 'user_id', 'book_id');
    }

    /**
     * @return HasMany
     */

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'user_id', 'id');
    }

    /**
     * @return BelongsToMany
     */

    public function purchasedBooks(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'purchasedbooks', 'user_id', 'book_id');
    }

    /**
     * @return BelongsToMany
     */

    public function subscribes(): BelongsToMany
    {
        return $this->belongsToMany(Subscribe::class);
    }




}

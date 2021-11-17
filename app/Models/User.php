<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @package App\Models
 *
 * @property  int $id
 * @property string $type
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property Carbon $birthday
 * @property integer $banned
 *
 *
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

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }

    public function booksInBasket(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'baskets', 'user_id', 'book_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'user_id', 'id');
    }


}

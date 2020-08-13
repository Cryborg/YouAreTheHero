<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function stories(): ?HasMany
    {
        return $this->hasMany(Story::class);
    }

    public function characters(): ?HasMany
    {
        return $this->hasMany(Character::class);
    }

    public function hasBeganStory(Story $story): bool
    {
        return Character::where([
            'user_id' => $this->id,
            'story_id' => $story->id,
        ])
        ->count() > 0;
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPassword($token));
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}

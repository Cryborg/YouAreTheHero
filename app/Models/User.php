<?php

namespace App\Models;

use App\Classes\Constants;
use App\Models\Inbox\Message;
use App\Notifications\ResetPassword;
use App\Traits\HasInbox;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements HasLocalePreference
{
    use Notifiable, SoftDeletes, HasFactory, HasInbox;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'locale',
        'optin_system',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'valid_from'        => 'datetime',
        'optin_system'      => 'boolean',
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

    public function successes()
    {
        return $this->belongsToMany(Success::class)
                    ->withPivot('created_at')
                    ->orderBy('pivot_created_at');
    }

    public function hasBeganStory(Story $story): bool
    {
        return Character::where([
                                    'user_id'  => $this->id,
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

    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale(): string
    {
        return $this->locale;
    }

    public function getAvatarAttribute($value)
    {
        if ($value === null) {
            return 'img/avatars/generic-avatar.png';
        }

        return Storage::url('avatars/' . $value);
    }

    public function getUsernameAttribute($value)
    {
        if ($this->role === Constants::ROLE_TEMPORARY) {
            return trans('user.anonymous.deleted_username');
        }

        return $value;
    }
}

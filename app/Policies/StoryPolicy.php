<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Story;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any stories.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //TODO: replace this when roles are created
        return in_array($user->id, [1, 2]);
    }

    /**
     * Determine whether the user can view the story.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Story  $story
     * @return mixed
     */
    public function view(User $user, Story $story)
    {
        return $user->id == $story->user_id || $user->can('isAdmin');
    }
}

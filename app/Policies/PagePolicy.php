<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the page.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page  $page
     * @return mixed
     */
    public function view(User $user, Page $page)
    {
        return $user->id == $page->story->user_id;
    }

    /**
     * @param \App\Models\User $user
     * @param \App\Models\Page $page
     *
     * @return bool
     */
    public function edit(User $user, Page $page)
    {
        return $user->id == $page->story->user_id;
    }
}

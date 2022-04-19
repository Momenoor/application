<?php

namespace App\Policies;

use App\Models\Matter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MatterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->canAny(['matter-view', 'matter-only-own-view']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Matter  $matter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Matter $matter)
    {
        if ($user->can('matter-only-own-view')) {
            return $user->expert->id === $matter->assistant->id;
        }

        if ($user->can('matter-view')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Matter  $matter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Matter $matter)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Matter  $matter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Matter $matter)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Matter  $matter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Matter $matter)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Matter  $matter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Matter $matter)
    {
        //
    }
}

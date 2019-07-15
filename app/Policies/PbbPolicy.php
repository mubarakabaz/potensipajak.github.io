<?php

namespace App\Policies;

use App\User;
use App\Pbb;
use Illuminate\Auth\Access\HandlesAuthorization;

class PbbPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the potensi pbb.
     *
     * @param  \App\User  $user
     * @param  \App\Pbb  $pbb
     * @return mixed
     */
    public function view(User $user, Pbb $pbb)
    {
        // Update $user authorization to view $pbb here.
        return true;
    }

    /**
     * Determine whether the user can create pbb.
     *
     * @param  \App\User  $user
     * @param  \App\Pbb  $pbb
     * @return mixed
     */
    public function create(User $user, Pbb $pbb)
    {
        // Update $user authorization to create $pbb here.
        return true;
    }

    /**
     * Determine whether the user can update the pbb.
     *
     * @param  \App\User  $user
     * @param  \App\Pbb  $pbb
     * @return mixed
     */
    public function update(User $user, Pbb $pbb)
    {
        // Update $user authorization to update $pbb here.
        return true;
    }

    /**
     * Determine whether the user can delete the pbb.
     *
     * @param  \App\User  $user
     * @param  \App\Pbb  $pbb
     * @return mixed
     */
    public function delete(User $user, Pbb $pbb)
    {
        // Update $user authorization to delete $pbb here.
        return true;
    }
}

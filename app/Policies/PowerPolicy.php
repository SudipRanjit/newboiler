<?php

namespace App\Policies;

use App\Webifi\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PowerPolicy
{
    use HandlesAuthorization;

    /**
     * Filter authorization before checking permissions
     *
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        if ($user->isSuperuser()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the powers.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasPermission('cms::powers.index');
    }

    /**
     * Determine whether the user can create powers.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('cms::powers.create');
    }

    /**
     * Determine whether the user can update the powers.
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasPermission('cms::powers.update');
    }

    /**
     * Determine whether the user can delete the powers.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('cms::powers.delete');
    }

}

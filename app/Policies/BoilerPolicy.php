<?php

namespace App\Policies;

use App\Webifi\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoilerPolicy
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
     * Determine whether the user can view the boilers.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasPermission('cms::boilers.index');
    }

    /**
     * Determine whether the user can create boilers.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('cms::boilers.create');
    }

    /**
     * Determine whether the user can update the boilers.
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasPermission('cms::boilers.update');
    }

    /**
     * Determine whether the user can delete the boilers.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('cms::boilers.delete');
    }

}

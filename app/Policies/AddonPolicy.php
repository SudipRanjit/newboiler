<?php

namespace App\Policies;

use App\Webifi\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddonPolicy
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
     * Determine whether the user can view the addons.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasPermission('cms::addons.index');
    }

    /**
     * Determine whether the user can create addons.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('cms::addons.create');
    }

    /**
     * Determine whether the user can update the addons.
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasPermission('cms::addons.update');
    }

    /**
     * Determine whether the user can delete the addons.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('cms::addons.delete');
    }

}

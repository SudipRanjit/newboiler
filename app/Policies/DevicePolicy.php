<?php

namespace App\Policies;

use App\Webifi\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DevicePolicy
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
     * Determine whether the user can view the devices.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasPermission('cms::devices.index');
    }

    /**
     * Determine whether the user can create devices.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('cms::devices.create');
    }

    /**
     * Determine whether the user can update the devices.
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasPermission('cms::devices.update');
    }

    /**
     * Determine whether the user can delete the devices.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('cms::devices.delete');
    }

}

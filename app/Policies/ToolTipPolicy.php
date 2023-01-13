<?php

namespace App\Policies;

use App\Webifi\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ToolTipPolicy
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
     * Determine whether the user can view the tooltips.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasPermission('cms::tooltips.index');
    }

    /**
     * Determine whether the user can create tooltips.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('cms::tooltips.create');
    }

    /**
     * Determine whether the user can update the tooltips.
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasPermission('cms::tooltips.update');
    }

    /**
     * Determine whether the user can delete the tooltips.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('cms::tooltips.delete');
    }

}

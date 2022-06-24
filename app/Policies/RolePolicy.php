<?php

namespace App\Policies;

use App\Webifi\Models\User\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Filter authorization before checking permissions
     *
     * @param Role $role
     * @return bool
     */
    public function before(Role $role)
    {
        if ($role->isSuperrole()) {
            return true;
        }
    }

    /**
     * Determine whether the role can view the role.
     *
     * @param Role $role
     * @return bool
     */
    public function view(Role $role)
    {
        return $role->hasPermission('cms::roles.index');
    }

    /**
     * Determine whether the role can create roles.
     *
     * @param  \App\GNepal\Models\Role\Role $role
     * @return bool
     */
    public function create(Role $role)
    {
        return $role->hasPermission('cms::roles.create');
    }

    /**
     * Determine whether the role can update the role.
     *
     * @param  \App\GNepal\Models\Role\Role $role
     * @return bool
     */
    public function update(Role $role)
    {
        return $role->hasPermission('cms::roles.update');
    }

    /**
     * Determine whether the role can delete the role.
     *
     * @param  \App\GNepal\Models\Role\Role $role
     * @return bool
     */
    public function delete(Role $role)
    {
        return $role->hasPermission('cms::roles.delete');
    }
}

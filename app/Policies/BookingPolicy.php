<?php

namespace App\Policies;

use App\Webifi\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
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
     * Determine whether the user can view the bookings.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasPermission('cms::bookings.index');
    }

    /**
     * Determine whether the user can create boilers.
     *
     * @param User $user
     * @return bool
     */
    /*public function create(User $user)
    {
        return $user->hasPermission('cms::boilers.create');
    }*/

    /**
     * Determine whether the user can update the booking.
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasPermission('cms::bookings.update');
    }

    /**
     * Determine whether the user can delete the boilers.
     *
     * @param User $user
     * @return bool
     */
    /*public function delete(User $user)
    {
        return $user->hasPermission('cms::boilers.delete');
    }*/

    /**
     * Determine whether the user can do stripe payout from customer.
     *
     * @param User $user
     * @return bool
     */
    public function stripe_payout(User $user)
    {
        return $user->hasPermission('cms::bookings.stripe_payout');
    }
}

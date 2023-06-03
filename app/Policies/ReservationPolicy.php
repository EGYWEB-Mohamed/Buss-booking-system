<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ReservationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view_any_reservation');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return Response|bool
     */
    public function view(User $user, Reservation $reservation)
    {
        return $user->can('view_reservation');
    }

    /**
     * Determine whether the user can create models.
     *
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create_reservation');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return Response|bool
     */
    public function update(User $user, Reservation $reservation)
    {
        return $user->can('update_reservation');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return Response|bool
     */
    public function delete(User $user, Reservation $reservation)
    {
        return $user->can('delete_reservation');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @return Response|bool
     */
    public function deleteAny(User $user)
    {
        return $user->can('delete_any_reservation');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @return Response|bool
     */
    public function forceDelete(User $user, Reservation $reservation)
    {
        return $user->can('force_delete_reservation');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @return Response|bool
     */
    public function forceDeleteAny(User $user)
    {
        return $user->can('force_delete_any_reservation');
    }

    /**
     * Determine whether the user can restore.
     *
     * @return Response|bool
     */
    public function restore(User $user, Reservation $reservation)
    {
        return $user->can('restore_reservation');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @return Response|bool
     */
    public function restoreAny(User $user)
    {
        return $user->can('restore_any_reservation');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @return Response|bool
     */
    public function replicate(User $user, Reservation $reservation)
    {
        return $user->can('replicate_reservation');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @return Response|bool
     */
    public function reorder(User $user)
    {
        return $user->can('reorder_reservation');
    }
}

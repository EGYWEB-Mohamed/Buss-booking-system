<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicles;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VehiclesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view_any_vehicles');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return Response|bool
     */
    public function view(User $user, Vehicles $vehicles)
    {
        return $user->can('view_vehicles');
    }

    /**
     * Determine whether the user can create models.
     *
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create_vehicles');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return Response|bool
     */
    public function update(User $user, Vehicles $vehicles)
    {
        return $user->can('update_vehicles');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return Response|bool
     */
    public function delete(User $user, Vehicles $vehicles)
    {
        return $user->can('delete_vehicles');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @return Response|bool
     */
    public function deleteAny(User $user)
    {
        return $user->can('delete_any_vehicles');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @return Response|bool
     */
    public function forceDelete(User $user, Vehicles $vehicles)
    {
        return $user->can('force_delete_vehicles');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @return Response|bool
     */
    public function forceDeleteAny(User $user)
    {
        return $user->can('force_delete_any_vehicles');
    }

    /**
     * Determine whether the user can restore.
     *
     * @return Response|bool
     */
    public function restore(User $user, Vehicles $vehicles)
    {
        return $user->can('restore_vehicles');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @return Response|bool
     */
    public function restoreAny(User $user)
    {
        return $user->can('restore_any_vehicles');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @return Response|bool
     */
    public function replicate(User $user, Vehicles $vehicles)
    {
        return $user->can('replicate_vehicles');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @return Response|bool
     */
    public function reorder(User $user)
    {
        return $user->can('reorder_vehicles');
    }
}

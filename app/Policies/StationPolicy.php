<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Policies;

use App\Models\Station;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view_any_station');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return Response|bool
     */
    public function view(User $user, Station $station)
    {
        return $user->can('view_station');
    }

    /**
     * Determine whether the user can create models.
     *
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create_station');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return Response|bool
     */
    public function update(User $user, Station $station)
    {
        return $user->can('update_station');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return Response|bool
     */
    public function delete(User $user, Station $station)
    {
        return $user->can('delete_station');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @return Response|bool
     */
    public function deleteAny(User $user)
    {
        return $user->can('delete_any_station');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @return Response|bool
     */
    public function forceDelete(User $user, Station $station)
    {
        return $user->can('force_delete_station');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @return Response|bool
     */
    public function forceDeleteAny(User $user)
    {
        return $user->can('force_delete_any_station');
    }

    /**
     * Determine whether the user can restore.
     *
     * @return Response|bool
     */
    public function restore(User $user, Station $station)
    {
        return $user->can('restore_station');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @return Response|bool
     */
    public function restoreAny(User $user)
    {
        return $user->can('restore_any_station');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @return Response|bool
     */
    public function replicate(User $user, Station $station)
    {
        return $user->can('replicate_station');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @return Response|bool
     */
    public function reorder(User $user)
    {
        return $user->can('reorder_station');
    }
}

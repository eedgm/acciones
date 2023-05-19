<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Prioridad;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrioridadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the prioridad can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list prioridads');
    }

    /**
     * Determine whether the prioridad can view the model.
     */
    public function view(User $user, Prioridad $model): bool
    {
        return $user->hasPermissionTo('view prioridads');
    }

    /**
     * Determine whether the prioridad can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create prioridads');
    }

    /**
     * Determine whether the prioridad can update the model.
     */
    public function update(User $user, Prioridad $model): bool
    {
        return $user->hasPermissionTo('update prioridads');
    }

    /**
     * Determine whether the prioridad can delete the model.
     */
    public function delete(User $user, Prioridad $model): bool
    {
        return $user->hasPermissionTo('delete prioridads');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete prioridads');
    }

    /**
     * Determine whether the prioridad can restore the model.
     */
    public function restore(User $user, Prioridad $model): bool
    {
        return false;
    }

    /**
     * Determine whether the prioridad can permanently delete the model.
     */
    public function forceDelete(User $user, Prioridad $model): bool
    {
        return false;
    }
}

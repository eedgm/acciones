<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agrupacion;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgrupacionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the agrupacion can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list agrupacions');
    }

    /**
     * Determine whether the agrupacion can view the model.
     */
    public function view(User $user, Agrupacion $model): bool
    {
        return $user->hasPermissionTo('view agrupacions');
    }

    /**
     * Determine whether the agrupacion can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create agrupacions');
    }

    /**
     * Determine whether the agrupacion can update the model.
     */
    public function update(User $user, Agrupacion $model): bool
    {
        return $user->hasPermissionTo('update agrupacions');
    }

    /**
     * Determine whether the agrupacion can delete the model.
     */
    public function delete(User $user, Agrupacion $model): bool
    {
        return $user->hasPermissionTo('delete agrupacions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete agrupacions');
    }

    /**
     * Determine whether the agrupacion can restore the model.
     */
    public function restore(User $user, Agrupacion $model): bool
    {
        return false;
    }

    /**
     * Determine whether the agrupacion can permanently delete the model.
     */
    public function forceDelete(User $user, Agrupacion $model): bool
    {
        return false;
    }
}

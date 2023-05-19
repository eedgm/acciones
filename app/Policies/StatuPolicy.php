<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Statu;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the statu can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list status');
    }

    /**
     * Determine whether the statu can view the model.
     */
    public function view(User $user, Statu $model): bool
    {
        return $user->hasPermissionTo('view status');
    }

    /**
     * Determine whether the statu can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create status');
    }

    /**
     * Determine whether the statu can update the model.
     */
    public function update(User $user, Statu $model): bool
    {
        return $user->hasPermissionTo('update status');
    }

    /**
     * Determine whether the statu can delete the model.
     */
    public function delete(User $user, Statu $model): bool
    {
        return $user->hasPermissionTo('delete status');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete status');
    }

    /**
     * Determine whether the statu can restore the model.
     */
    public function restore(User $user, Statu $model): bool
    {
        return false;
    }

    /**
     * Determine whether the statu can permanently delete the model.
     */
    public function forceDelete(User $user, Statu $model): bool
    {
        return false;
    }
}

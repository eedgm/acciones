<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Action;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the action can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list actions');
    }

    /**
     * Determine whether the action can view the model.
     */
    public function view(User $user, Action $model): bool
    {
        return $user->hasPermissionTo('view actions');
    }

    /**
     * Determine whether the action can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create actions');
    }

    /**
     * Determine whether the action can update the model.
     */
    public function update(User $user, Action $model): bool
    {
        return $user->hasPermissionTo('update actions');
    }

    /**
     * Determine whether the action can delete the model.
     */
    public function delete(User $user, Action $model): bool
    {
        return $user->hasPermissionTo('delete actions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete actions');
    }

    /**
     * Determine whether the action can restore the model.
     */
    public function restore(User $user, Action $model): bool
    {
        return false;
    }

    /**
     * Determine whether the action can permanently delete the model.
     */
    public function forceDelete(User $user, Action $model): bool
    {
        return false;
    }
}

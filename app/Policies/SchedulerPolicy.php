<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Scheduler;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the scheduler can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the scheduler can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Scheduler  $model
     * @return mixed
     */
    public function view(User $user, Scheduler $model)
    {
        return true;
    }

    /**
     * Determine whether the scheduler can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the scheduler can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Scheduler  $model
     * @return mixed
     */
    public function update(User $user, Scheduler $model)
    {
        return true;
    }

    /**
     * Determine whether the scheduler can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Scheduler  $model
     * @return mixed
     */
    public function delete(User $user, Scheduler $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Scheduler  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the scheduler can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Scheduler  $model
     * @return mixed
     */
    public function restore(User $user, Scheduler $model)
    {
        return false;
    }

    /**
     * Determine whether the scheduler can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Scheduler  $model
     * @return mixed
     */
    public function forceDelete(User $user, Scheduler $model)
    {
        return false;
    }
}

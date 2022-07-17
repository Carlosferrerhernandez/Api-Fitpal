<?php

namespace App\Policies;

use App\Models\Gym;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GymPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the gym can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the gym can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Gym  $model
     * @return mixed
     */
    public function view(User $user, Gym $model)
    {
        return true;
    }

    /**
     * Determine whether the gym can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the gym can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Gym  $model
     * @return mixed
     */
    public function update(User $user, Gym $model)
    {
        return true;
    }

    /**
     * Determine whether the gym can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Gym  $model
     * @return mixed
     */
    public function delete(User $user, Gym $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Gym  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the gym can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Gym  $model
     * @return mixed
     */
    public function restore(User $user, Gym $model)
    {
        return false;
    }

    /**
     * Determine whether the gym can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Gym  $model
     * @return mixed
     */
    public function forceDelete(User $user, Gym $model)
    {
        return false;
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Trainer;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the trainer can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the trainer can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trainer  $model
     * @return mixed
     */
    public function view(User $user, Trainer $model)
    {
        return true;
    }

    /**
     * Determine whether the trainer can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the trainer can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trainer  $model
     * @return mixed
     */
    public function update(User $user, Trainer $model)
    {
        return true;
    }

    /**
     * Determine whether the trainer can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trainer  $model
     * @return mixed
     */
    public function delete(User $user, Trainer $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trainer  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the trainer can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trainer  $model
     * @return mixed
     */
    public function restore(User $user, Trainer $model)
    {
        return false;
    }

    /**
     * Determine whether the trainer can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trainer  $model
     * @return mixed
     */
    public function forceDelete(User $user, Trainer $model)
    {
        return false;
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lesson;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the lesson can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the lesson can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Lesson  $model
     * @return mixed
     */
    public function view(User $user, Lesson $model)
    {
        return true;
    }

    /**
     * Determine whether the lesson can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the lesson can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Lesson  $model
     * @return mixed
     */
    public function update(User $user, Lesson $model)
    {
        return true;
    }

    /**
     * Determine whether the lesson can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Lesson  $model
     * @return mixed
     */
    public function delete(User $user, Lesson $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Lesson  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the lesson can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Lesson  $model
     * @return mixed
     */
    public function restore(User $user, Lesson $model)
    {
        return false;
    }

    /**
     * Determine whether the lesson can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Lesson  $model
     * @return mixed
     */
    public function forceDelete(User $user, Lesson $model)
    {
        return false;
    }
}

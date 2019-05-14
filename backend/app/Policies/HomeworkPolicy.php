<?php

namespace App\Policies;

use App\User;
use App\Homework;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomeworkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the homework.
     *
     * @param  \App\User  $user
     * @param  \App\Homework  $homework
     * @return mixed
     */
    public function view(User $user, Homework $homework)
    {
        return true;
    }

    /**
     * Determine whether the user can create homeworks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the homework.
     *
     * @param  \App\User  $user
     * @param  \App\Homework  $homework
     * @return mixed
     */
    public function update(User $user, Homework $homework)
    {
        return $user->permission_id > 1 || $user->id === $homework->user_id;
    }

    /**
     * Determine whether the user can delete the homework.
     *
     * @param  \App\User  $user
     * @param  \App\Homework  $homework
     * @return mixed
     */
    public function delete(User $user, Homework $homework)
    {
        return $user->permission_id > 2 || $user->id === $homework->user_id;
    }

    /**
     * Determine whether the user can restore the homework.
     *
     * @param  \App\User  $user
     * @param  \App\Homework  $homework
     * @return mixed
     */
    public function restore(User $user, Homework $homework)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the homework.
     *
     * @param  \App\User  $user
     * @param  \App\Homework  $homework
     * @return mixed
     */
    public function forceDelete(User $user, Homework $homework)
    {
        //
    }
}

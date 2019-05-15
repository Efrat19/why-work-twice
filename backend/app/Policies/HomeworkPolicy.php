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
        return $user->isAdmin() || $user->id === $homework->user_id;
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
        return $user->isSuperadmin() || $user->id === $homework->user_id;
    }


}

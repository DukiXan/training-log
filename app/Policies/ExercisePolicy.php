<?php

namespace App\Policies;

use App\User;
use App\Exercise;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExercisePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given user can delete the given exercise.
     *
     * @param  User $user
     * @param  Exercise $exercise
     * @return bool
     */
    public function canPerformAction(User $user, Exercise $exercise)
    {
        return $user->id == $exercise->user_id;
    }
}

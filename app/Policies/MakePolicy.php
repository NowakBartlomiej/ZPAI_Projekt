<?php

namespace App\Policies;

use App\Models\Make;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MakePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('makes.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // public function view(User $user, Make $make)
    // {
    //     //
    // }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('makes.manage');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Make $make)
    {
        return $make->deleted_at === null 
            && $user->can('makes.manage');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Make $make)
    {
        return $make->deleted_at === null 
            && $user->can('makes.manage');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Make $make)
    {
        return $make->deleted_at !== null 
            && $user->can('makes.manage');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // public function forceDelete(User $user, Make $make)
    // {
    //     //
    // }
}

<?php

namespace App\Policies;

use App\Models\County;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountyPolicy
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
        return $user->can('counties.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\County  $county
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // public function view(User $user, County $county)
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
        return $user->can('counties.manage');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\County  $county
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, County $county)
    {
        return $county->deleted_at === null 
            && $user->can('counties.manage');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\County  $county
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, County $county)
    {
        return $county->deleted_at === null 
            && $user->can('counties.manage');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\County  $county
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, County $county)
    {
        return $county->deleted_at !== null 
            && $user->can('counties.manage');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\County  $county
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // public function forceDelete(User $user, County $county)
    // {
    //     //
    // }
}

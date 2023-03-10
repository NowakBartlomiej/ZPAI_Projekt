<?php

namespace App\Policies;

use App\Models\Fuel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FuelPolicy
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
        return $user->can('fuels.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // public function view(User $user, Fuel $fuel)
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
        return $user->can('fuels.manage');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Fuel $fuel)
    {
        return $fuel->deleted_at === null 
            && $user->can('fuels.manage');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Fuel $fuel)
    {
        return $fuel->deleted_at === null 
            && $user->can('fuels.manage');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Fuel $fuel)
    {
        return $fuel->deleted_at !== null 
            && $user->can('fuels.manage');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // public function forceDelete(User $user, Fuel $fuel)
    // {
    //     //
    // }
}

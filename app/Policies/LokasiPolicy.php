<?php

namespace App\Policies;

use App\Models\User;
use App\Models\lokasi;
use Illuminate\Auth\Access\HandlesAuthorization;

class LokasiPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\lokasi  $lokasi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, lokasi $lokasi)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\lokasi  $lokasi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, lokasi $lokasi)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\lokasi  $lokasi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, lokasi $lokasi)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\lokasi  $lokasi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, lokasi $lokasi)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\lokasi  $lokasi
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, lokasi $lokasi)
    {
        //
    }
}

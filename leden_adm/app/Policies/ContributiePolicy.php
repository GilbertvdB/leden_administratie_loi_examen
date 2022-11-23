<?php

namespace App\Policies;

use App\Models\Contributie;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ContributiePolicy
{
    use HandlesAuthorization;
    
    /**
    * Perform pre-authorization checks.
    *
    * @param  \App\Models\User  $user
    * @param  string  $ability
    * @return void|bool
    */
   public function before(User $user)
   {
       if ($user->role_id == Role::ADMIN) {
           return true;
       }
   }

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
     * @param  \App\Models\Contributie  $contributie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Contributie $contributie)
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
        return $user->role_id == Role::PENNINGMEESTER
		? Response::allow()
                : Response::deny('You do not have the permission for this action.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contributie  $contributie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->role_id == Role::PENNINGMEESTER
		? Response::allow()
                : Response::deny('You do not have the permission for this action.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contributie  $contributie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Contributie $contributie)
    {
        return $user->role_id == Role::PENNINGMEESTER
		? Response::allow()
                : Response::deny('You do not have the permission for this action.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contributie  $contributie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Contributie $contributie)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contributie  $contributie
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Contributie $contributie)
    {
        return $user->role_id == Role::PENNINGMEESTER
		? Response::allow()
                : Response::deny('You do not have the permission for this action.');
    }
}

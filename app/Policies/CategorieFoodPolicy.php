<?php

namespace App\Policies;

use App\Models\categorie_food;
use App\Models\User;

class CategorieFoodPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, categorie_food $categorieFood): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()->IsAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, categorie_food $categorieFood): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, categorie_food $categorieFood): bool
    {
        return auth()->user()->IsAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, categorie_food $categorieFood): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, categorie_food $categorieFood): bool
    {
        //
    }
}

<?php

namespace App\Policies;

use App\Models\FormationRegistration;
use App\Models\User;

class FormationRegistrationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'Manager']);
    }

    public function view(User $user, FormationRegistration $formationRegistration): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'Manager']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'Manager']);
    }

    public function update(User $user, FormationRegistration $formationRegistration): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'Manager']);
    }

    public function delete(User $user, FormationRegistration $formationRegistration): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'Manager']);
    }

    public function restore(User $user, FormationRegistration $formationRegistration): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'Manager']);
    }

    public function forceDelete(User $user, FormationRegistration $formationRegistration): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'Manager']);
    }
}

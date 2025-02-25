<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CarePlan;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarePlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can view any care plans.
     */
    public function viewAny(User $user)
    {
        // Log the role type for debugging
        \Log::info('Checking viewAny for user role:', ['role' => $user->role ? $user->role->roletype : 'No role']);

        // Ensure role is loaded and check if the role is Manager or Staff
        return $user->role && $user->role->roletype && in_array($user->role->roletype, ['Manager', 'Staff']);
    }

    /**
     * Determine if the user can create a care plan.
     */
    public function create(User $user)
    {
        // Log the role type for debugging
        \Log::info('Checking create for user role:', ['role' => $user->role ? $user->role->roletype : 'No role']);

        // Ensure role is loaded and check if the role is Manager
        return $user->role && $user->role->roletype === 'Manager';
    }

    /**
     * Determine if the user can update the care plan.
     */
    public function update(User $user, CarePlan $carePlan)
    {
        // Log the role type for debugging
        \Log::info('Checking update for user role:', ['role' => $user->role ? $user->role->roletype : 'No role']);

        // Ensure role is loaded and check if the role is Manager
        return $user->role && $user->role->roletype === 'Manager';
    }

    /**
     * Determine if the user can personalize the care plan.
     */
    public function personalize(User $user, CarePlan $carePlan)
    {
        // Log the role type for debugging
        \Log::info('Checking personalize for user role:', ['role' => $user->role ? $user->role->roletype : 'No role']);

        // Ensure role is loaded and check if the role is Manager
        return $user->role && $user->role->roletype === 'Manager';
    }

    /**
     * Determine if the user can delete the care plan.
     */
    public function delete(User $user, CarePlan $carePlan)
    {
        // Log the role type for debugging
        \Log::info('Checking delete for user role:', ['role' => $user->role ? $user->role->roletype : 'No role']);

        // Ensure role is loaded and check if the role is Manager
        return $user->role && $user->role->roletype === 'Manager';
    }

    /**
     * Determine if the user can view the care plan.
     */
    public function view(User $user, CarePlan $carePlan)
    {
        // Log the role type for debugging
        \Log::info('Checking view for user role:', ['role' => $user->role ? $user->role->roletype : 'No role']);

        // Ensure role is loaded and check if the role is Manager or Staff
        return $user->role && $user->role->roletype && in_array($user->role->roletype, ['Manager', 'Staff']);
    }
}

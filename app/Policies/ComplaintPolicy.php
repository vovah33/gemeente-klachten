<?php

namespace App\Policies;

use App\Models\Complaint;
use App\Models\User;

class ComplaintPolicy
{
    public function view(?User $user, Complaint $complaint): bool
    {
        return ($user && $user->id === $complaint->user_id) || ($user && $user->role === 'admin');
    }

    public function create(User $user): bool
    {
        return (bool) $user;
    }

    public function store(User $user): bool
    {
        return (bool) $user;
    }
}


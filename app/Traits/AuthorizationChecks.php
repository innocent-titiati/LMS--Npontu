<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait AuthorizationChecks
{
    protected function checkRole($role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Unauthorized action.');
        }
    }
} 
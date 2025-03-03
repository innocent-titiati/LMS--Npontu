<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Traits\AuthorizationChecks;

class HRController extends Controller
{
    use AuthorizationChecks;

    public function dashboard()
    {
        $this->checkRole('hr');
        return view('hr.dashboard'); // Ensure this Blade file exists
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Traits\AuthorizationChecks;

class EmployeeController extends Controller
{
    use AuthorizationChecks;

    public function dashboard()
    {
        $this->checkRole('employee');
        return view('employee.dashboard');
    }
}

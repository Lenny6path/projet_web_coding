<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = $user->schools()->first()?->pivot->role;

        if ($role === 'admin') {
            return view('pages.dashboard.dashboard-admin', [
                'cohortsCount'  => Cohort::count(),
                'studentsCount' => User::whereHas('schools', fn ($q) => $q->where('users_schools.role', 'student'))->count(),
                'teachersCount' => User::whereHas('schools', fn ($q) => $q->where('users_schools.role', 'teacher'))->count(),
                'groupsCount'   => 0,
            ]);
        }

        return view('pages.dashboard.dashboard-' . $role);
    }
}







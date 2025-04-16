<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        // Récupère les promotions + rétrospectives
        $cohorts = $user->teachingCohorts()->with(['retros' => fn($q) => $q->where('is_active', true)])->get();

        return view('pages.dashboard.dashboard-teacher', compact('cohorts'));
    }

}

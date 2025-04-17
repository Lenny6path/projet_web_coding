<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{




    /*public function index()
    {
        $user = auth()->user();

        return view('pages.dashboard.dashboard-student', [
            'todoAssessments' => $user->assessments()->wherePivot('status', 'todo')->get(),
            'doneAssessments' => $user->assessments()->wherePivot('status', 'done')->get(),
            'pendingTasks'    => $user->commonTasks()->whereNull('common_task_user.done_at')->get(),
            'doneTasks'       => $user->commonTasks()->whereNotNull('common_task_user.done_at')->get(),
        ]);
    }*/




    public function index()
    {
        $students = User::whereHas('schools', function ($q) {
            $q->where('users_schools.role', 'student');
        })->get();

        return view('pages.students.index', compact('students'));
    }

    public function create()
    {
        $cohorts = Cohort::all();
        return view('pages.students.create', compact('cohorts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:users',
            'cohort_id' => 'required|exists:cohorts,id',
        ]);

        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make('student123'), // ou formulaire ?
        ]);

        // On suppose que chaque cohort appartient à une school
        $school_id = Cohort::find($request->cohort_id)->school_id;

        $user->schools()->attach($school_id, ['role' => 'student']);

        return redirect()->route('students.index')->with('success', 'Étudiant ajouté.');
    }

    public function edit(User $student)
    {
        $cohorts = Cohort::all();
        return view('pages.students.edit', compact('student', 'cohorts'));
    }

    public function update(Request $request, User $student)
    {
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $student->id,
        ]);

        $student->update($request->only(['last_name', 'first_name', 'email']));

        return redirect()->route('students.index')->with('success', 'Étudiant modifié.');
    }

    public function destroy(User $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Étudiant supprimé.');
    }
}

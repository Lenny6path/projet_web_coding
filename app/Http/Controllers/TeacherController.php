<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::whereHas('schools', function ($q) {
            $q->where('users_schools.role', 'teacher');
        })->get();

        return view('pages.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('pages.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        $teacher = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => bcrypt('defaultPassword123'), // à changer selon contexte
        ]);

        $teacher->schools()->attach(auth()->user()->school()->id, ['role' => 'teacher']);

        return redirect()->route('teachers.index')->with('success', 'Enseignant ajouté avec succès.');
    }

    public function edit(User $teacher)
    {
        return view('pages.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, User $teacher)
    {
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $teacher->id,
        ]);

        $teacher->update($request->only('last_name', 'first_name', 'email'));

        return redirect()->route('teachers.index')->with('success', 'Enseignant modifié avec succès.');
    }

    public function destroy(User $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Enseignant supprimé.');
    }

}

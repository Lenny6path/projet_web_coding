<?php

namespace App\Http\Controllers;

// Import du modèle User
use App\Models\User;
use Illuminate\Http\Request;

// Contrôleur qui gère les enseignants (teacher)
class TeacherController extends Controller
{
    /**
     * Affiche la liste de tous les enseignants de l'école de l'utilisateur connecté.
     */
    public function index()
    {
        // On récupère les utilisateurs qui ont un rôle 'teacher' dans une école
        $teachers = User::whereHas('schools', function ($q) {
            $q->where('users_schools.role', 'teacher');
        })->get();

        // On envoie la liste des enseignants à la vue
        return view('pages.teachers.index', compact('teachers'));
    }

    /**
     * Affiche le formulaire de création d’un enseignant.
     */
    public function create()
    {
        return view('pages.teachers.create');
    }

    /**
     * Enregistre un nouvel enseignant en base de données.
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'last_name'  => 'required',
            'first_name' => 'required',
            'email'      => 'required|email|unique:users,email',
        ]);

        // Création d’un nouvel utilisateur avec un mot de passe par défaut (à améliorer plus tard)
        $teacher = User::create([
            'last_name'  => $request->last_name,
            'first_name' => $request->first_name,
            'email'      => $request->email,
            'password'   => bcrypt('defaultPassword123'), // ⚠️ À changer ou rendre personnalisable
        ]);

        // Association du teacher à l'école de l'utilisateur connecté, avec rôle "teacher"
        $teacher->schools()->attach(auth()->user()->school()->id, ['role' => 'teacher']);

        // Redirection vers la liste avec un message de succès
        return redirect()->route('teachers.index')->with('success', 'Enseignant ajouté avec succès.');
    }

    /**
     * Affiche le formulaire de modification d’un enseignant.
     */
    public function edit(User $teacher)
    {
        return view('pages.teachers.edit', compact('teacher'));
    }

    /**
     * Met à jour les données de l’enseignant sélectionné.
     */
    public function update(Request $request, User $teacher)
    {
        // Validation des données, sauf si l'email reste le même
        $request->validate([
            'last_name'  => 'required',
            'first_name' => 'required',
            'email'      => 'required|email|unique:users,email,' . $teacher->id,
        ]);

        // Mise à jour des données
        $teacher->update($request->only('last_name', 'first_name', 'email'));

        return redirect()->route('teachers.index')->with('success', 'Enseignant modifié avec succès.');
    }

    /**
     * Supprime un enseignant de la base de données.
     */
    public function destroy(User $teacher)
    {
        // Suppression de l’utilisateur (soft delete si activé)
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Enseignant supprimé.');
    }
}

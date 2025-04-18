<?php

namespace App\Http\Controllers;

// Importation des modèles nécessaires
use App\Models\Cohort;
use App\Models\User;
use Illuminate\Http\Request;

// Contrôleur chargé de gérer l'affichage du tableau de bord selon le rôle de l'utilisateur connecté
class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord personnalisé selon le rôle de l'utilisateur (admin, student, teacher, etc.).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupère l'utilisateur actuellement connecté via le système d'authentification Laravel
        $user = auth()->user();

        // Récupère le rôle de l'utilisateur dans sa première école associée (via la table pivot users_schools)
        $role = $user->schools()->first()?->pivot->role;

        // Si l'utilisateur est un administrateur, on affiche un tableau de bord complet avec les statistiques
        if ($role === 'admin') {
            return view('pages.dashboard.dashboard-admin', [
                // Nombre total de promotions (cohorts)
                'cohortsCount'  => Cohort::count(),

                // Nombre total d'étudiants (users liés à une école avec le rôle "student")
                'studentsCount' => User::whereHas('schools', fn ($q) => $q->where('users_schools.role', 'student'))->count(),

                // Nombre total d'enseignants (users liés à une école avec le rôle "teacher")
                'teachersCount' => User::whereHas('schools', fn ($q) => $q->where('users_schools.role', 'teacher'))->count(),

                // Compteur des groupes, à personnaliser si nécessaire (ici fixé à 0)
                'groupsCount'   => 0,
            ]);
        }

        // Si ce n'est pas un admin, on redirige vers le tableau de bord spécifique à son rôle
        return view('pages.dashboard.dashboard-' . $role);
    }
}

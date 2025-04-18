<?php

namespace App\Http\Controllers;

// Importation de la classe de requête personnalisée pour valider les données de mise à jour du profil
use App\Http\Requests\ProfileUpdateRequest;

// Gestion des redirections et requêtes
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

// Gestion de l'affichage des vues
use Illuminate\View\View;

// Contrôleur responsable de la gestion du profil utilisateur
class ProfileController extends Controller
{
    /**
     * Affiche le formulaire d'édition du profil de l'utilisateur connecté.
     *
     * @param Request $request
     * @return View
     */
    public function edit(Request $request): View
    {
        // Retourne la vue d'édition du profil avec les données de l'utilisateur connecté
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Met à jour les informations du profil de l'utilisateur.
     *
     * @param ProfileUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Remplit les champs de l'utilisateur avec les données validées (via la classe ProfileUpdateRequest)
        $request->user()->fill($request->validated());

        // Si l'e-mail a été modifié, on annule la vérification de l'ancien e-mail
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Sauvegarde des modifications dans la base de données
        $request->user()->save();

        // Redirection vers le formulaire avec un message de confirmation
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Supprime le compte de l'utilisateur connecté.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validation du mot de passe actuel avant la suppression, avec gestion des erreurs dans un "bag" nommé
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // Récupération de l'utilisateur connecté
        $user = $request->user();

        // Déconnexion de l'utilisateur
        Auth::logout();

        // Suppression du compte utilisateur
        $user->delete();

        // Invalidation de la session actuelle
        $request->session()->invalidate();

        // Régénération du token CSRF pour sécuriser la suite de la navigation
        $request->session()->regenerateToken();

        // Redirection vers la page d'accueil après suppression
        return Redirect::to('/');
    }
}

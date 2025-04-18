<?php

namespace App\Http\Controllers;

// Importation du modèle Cohort pour interagir avec la table des promotions
use App\Models\Cohort;

// Importation des contrats nécessaires pour la gestion des vues
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

// Permet de récupérer les données envoyées via les requêtes HTTP
use Illuminate\Http\Request;

// Déclaration du contrôleur dédié à la gestion des promotions (Cohorts)
class CohortController extends Controller
{
    /**
     * Affiche la liste de toutes les promotions existantes.
     *
     * @return View|Application|Factory
     */
    public function index()
    {
        // Récupération de toutes les promotions depuis la base de données
        $cohorts = Cohort::all();

        // Retourne la vue qui affiche les promotions avec les données récupérées
        return view('pages.cohorts.index', compact('cohorts'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle promotion.
     *
     * @return View|Application|Factory
     */
    public function create()
    {
        // Affiche la vue contenant le formulaire de création
        return view('pages.cohorts.create');
    }

    /**
     * Enregistre une nouvelle promotion dans la base de données.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données reçues depuis le formulaire
        $request->validate([
            'name' => 'required|string|max:255', // Le nom est obligatoire, doit être une chaîne de caractères et max 255 caractères
        ]);

        // Création de la promotion avec uniquement le champ 'name'
        Cohort::create($request->only('name'));

        // Redirection vers la liste avec un message de succès
        return redirect()->route('cohorts.index')->with('success', 'Promotion ajoutée');
    }

    /**
     * Affiche le formulaire d'édition d'une promotion existante.
     *
     * @param Cohort $cohort
     * @return View|Application|Factory
     */
    public function edit(Cohort $cohort)
    {
        // Affiche la vue de modification avec les données de la promotion sélectionnée
        return view('pages.cohorts.edit', compact('cohort'));
    }

    /**
     * Met à jour une promotion existante avec les nouvelles données.
     *
     * @param Request $request
     * @param Cohort $cohort
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Cohort $cohort)
    {
        // Validation des données envoyées pour la mise à jour
        $request->validate([
            'name' => 'required|string|max:255', // Toujours les mêmes règles que pour la création
        ]);

        // Mise à jour de la promotion avec la nouvelle valeur du nom
        $cohort->update($request->only('name'));

        // Redirection avec un message de confirmation
        return redirect()->route('cohorts.index')->with('success', 'Promotion mise à jour');
    }

    /**
     * Supprime une promotion de la base de données.
     *
     * @param Cohort $cohort
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Cohort $cohort)
    {
        // Suppression de la promotion sélectionnée
        $cohort->delete();

        // Redirection vers la liste avec un message de suppression
        return redirect()->route('cohorts.index')->with('success', 'Promotion supprimée');
    }
}

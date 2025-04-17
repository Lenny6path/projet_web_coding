<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class CohortController extends Controller
{
    public function index()
    {
        $cohorts = Cohort::all();
        return view('pages.cohorts.index', compact('cohorts'));
    }

    public function create()
    {
        return view('pages.cohorts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Cohort::create($request->only('name'));

        return redirect()->route('cohorts.index')->with('success', 'Promotion ajoutée');
    }

    public function edit(Cohort $cohort)
    {
        return view('pages.cohorts.edit', compact('cohort'));
    }

    public function update(Request $request, Cohort $cohort)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $cohort->update($request->only('name'));

        return redirect()->route('cohorts.index')->with('success', 'Promotion mise à jour');
    }

    public function destroy(Cohort $cohort)
    {
        $cohort->delete();
        return redirect()->route('cohorts.index')->with('success', 'Promotion supprimée');
    }
}

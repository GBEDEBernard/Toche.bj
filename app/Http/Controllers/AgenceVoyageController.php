<?php

namespace App\Http\Controllers;

use App\Models\AgenceVoyage;
use Illuminate\Http\Request;

class AgenceVoyageController extends Controller
{
    // Affiche la liste des agences de l'utilisateur connecté
    public function index()
    {
        $agences = AgenceVoyage::where('user_id', auth()->id())->get();
        return view('Admin.Agence_voyage.index', compact('agences'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('Admin.Agence_voyage.create');
    }

    // Enregistre une nouvelle agence
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact' => 'required|string|max:100',
            'photo' => 'nullable|image|max:2048',
            'adresse' => 'required|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('agences_photos', 'public');
            $validated['photo'] = $path;
        }

        AgenceVoyage::create($validated);

        return redirect()->route('agence.index')->with('success', 'Agence créée avec succès !');
    }

    // Affiche le formulaire d'édition
    public function edit($id)
    {
        $agence = AgenceVoyage::findOrFail($id);

        // Sécurité : vérifier que l'agence appartient bien à l'utilisateur
        if ($agence->user_id !== auth()->id()) {
            abort(403, "Tu n'as pas le droit de modifier cette agence.");
        }

        return view('Admin.Agence_voyage.edit', compact('agence'));
    }

    // Met à jour l'agence
    public function update(Request $request, $id)
    {
        $agence = AgenceVoyage::findOrFail($id);

        if ($agence->user_id !== auth()->id()) {
            abort(403, "Tu n'as pas le droit de modifier cette agence.");
        }

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact' => 'required|string|max:100',
            'photo' => 'nullable|image|max:2048',
            'adresse' => 'required|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('agences_photos', 'public');
            $validated['photo'] = $path;
        }

        $agence->update($validated);

        return redirect()->route('agence.index')->with('success', 'Agence mise à jour avec succès !');
    }

    // Supprime une agence
    public function destroy($id)
    {
        $agence = AgenceVoyage::findOrFail($id);

        if ($agence->user_id !== auth()->id()) {
            abort(403, "Tu n'as pas le droit de supprimer cette agence.");
        }

        $agence->delete();

        return redirect()->route('agence.index')->with('success', 'Agence supprimée !');
    }
}

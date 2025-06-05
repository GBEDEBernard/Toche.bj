<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    // Créer un avis (ou une réponse)
    public function store(Request $request)
    {
        $data = $request->validate([
            'avisable_id' => 'required|integer',
            'avisable_type' => 'required|string',
            'commentaire' => 'required|string|max:1000',
            'note' => 'required|integer|min:1|max:5',
            'parent_id' => 'nullable|integer|exists:avis,id',
        ]);

        $data['user_id'] = Auth::id();
        $data['statut'] = 'en_attente'; // modération

        Avis::create($data);

        return back()->with('success', 'Merci pour votre avis ! Il sera visible après modération.');
    }

    // Modifier le statut (admin)
    public function updateStatut(Request $request, Avis $avis)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,approuvé,refusé',
        ]);

        $avis->statut = $request->statut;
        $avis->save();

        return back()->with('success', "L'avis a été mis à jour.");
    }

    // Liste d'avis (vue admin)
    public function index(Request $request)
    {
        $avis = Avis::with(['user', 'avisable'])
            ->when($request->statut, fn($q) => $q->where('statut', $request->statut))
            ->when($request->search, fn($q) => $q->where('commentaire', 'like', '%'.$request->search.'%'))
            ->latest()
            ->paginate(10);
    
        return view('Admin.Avis.index', compact('avis'));
    }

    public function approuver(Avis $avis)
    {
        $avis->update(['statut' => 'approuvé']);
        return back()->with('success', 'Avis approuvé.');
    }

    public function refuser(Avis $avis)
    {
        $avis->update(['statut' => 'refusé']);
        return back()->with('error', 'Avis refusé.');
    }

    public function repondre(Request $request, $id)
    {
        $request->validate([
            'reponse' => 'required|string|max:1000',
        ]);

        $avis = Avis::findOrFail($id);
        $avis->reponse = $request->reponse;
        $avis->save();

        return back()->with('success', 'Réponse envoyée avec succès.');
    }

// controlleur pour qu'une utilisateurs modifie son commentaire
    public function update(Request $request, Avis $avis)
{
    // Check que c’est bien l’auteur
    if ($avis->user_id !== Auth::id()) {
        abort(403, "T'as pas le droit de modifier cet avis.");
    }

    $request->validate([
        'commentaire' => 'required|string|max:1000',
    ]);

    $avis->commentaire = $request->commentaire;
    // Optionnel : tu peux reset le statut à 'en_attente' pour revalidation admin
    $avis->statut = 'en_attente'; 
    $avis->save();

    return redirect()->back()->with('success', 'Avis modifié et en attente de validation.');
}

}

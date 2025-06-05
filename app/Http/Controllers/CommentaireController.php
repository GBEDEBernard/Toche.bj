<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;

class CommentaireController extends Controller
{
    //
    public function store(Request $request)
{
    $request->validate([
        'contenu' => 'required',
        'evenement_id' => 'nullable|exists:evenements,id',
        'site_touristique_id' => 'nullable|exists:site_touristiques,id',
    ]);

    Commentaire::create([
        'contenu' => $request->contenu,
        'user_id' => auth()->id(),
        'evenement_id' => $request->evenement_id,
        'site_touristique_id' => $request->site_touristique_id,
    ]);

    return back()->with('success', 'Commentaire ajouté !');
}

}

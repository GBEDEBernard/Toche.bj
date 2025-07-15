<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemandeParticipation;
use App\Mail\DemandeReponseMail;
use Illuminate\Support\Facades\Mail;
class DemandeParticipationController extends Controller
{
    //
    

public function store(Request $request, $itineraire_id)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'email' => 'required|email',
        'message' => 'required|string|max:1000',
    ]);

    $validated['itineraire_id'] = $itineraire_id;

    DemandeParticipation::create($validated);

    return redirect()->route('itineraire.offres')->with('success', 'Votre demande a été envoyée avec succès !');
}
public function repondre(Request $request, $id)
{
    $demande = DemandeParticipation::findOrFail($id);

    $request->validate([
        'message' => 'required|string|max:1000',
    ]);

    Mail::to($demande->email)->send(new DemandeReponseMail(
        $demande->nom,
        $request->message,
        $demande->itineraire
    ));
    $demande->reponse = $request->message;
    $demande->save();
    return back()->with('success', 'Réponse envoyée à ' . $demande->email);
    

}

}

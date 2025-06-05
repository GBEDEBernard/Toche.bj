<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('reservation')->latest()->get();
        return view('Admin.paiement.index', compact('paiements'));
    }

    public function create()
    {
        $reservations = Reservation::all();
        return view('Admin.paiement.create', compact('reservations'));
    }

    public function store(Request $request)
    {
        // Validation avec format date compatible MySQL datetime
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'mode' => 'required|string|max:255',
            'reference' => 'required|string|unique:paiements,reference|max:255',
            'date_paiement' => 'required|date_format:Y-m-d\TH:i', // correspond à datetime-local input HTML
            'statut' => 'required|string|in:en_attente,payé,échoué',
        ]);
    
        // Convertir la date au bon format pour la BDD (si besoin)
        $validated['date_paiement'] = date('Y-m-d H:i:s', strtotime($validated['date_paiement']));
    
        // Création
        Paiement::create($validated);
    
        return redirect()->route('paiement.index')->with('success', 'Paiement ajouté avec succès.');
    }
    
    public function show(Paiement $paiement)
    {
        return view('Admin.paiement.show', compact('paiement'));
    }

    public function edit(Paiement $paiement)
    {
        $reservations = Reservation::all();
        return view('Admin.paiement.edit', compact('paiement', 'reservations'));
    }

    public function update(Request $request, Paiement $paiement)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'type_paiement' => 'required|string',
            'reference' => 'required|unique:paiements,reference,' . $paiement->id,
            'date_paiement' => 'required|date',
            'statut' => 'required|string',
        ]);

        $paiement->update($request->all());
        return redirect()->route('paiement.index')->with('success', 'Paiement mis à jour.');
    }

    public function destroy(Paiement $paiement)
    {
        $paiement->delete();
        return redirect()->route('paiement.index')->with('success', 'Paiement supprimé.');
    }

// Contrôleur pour les paiements

public function formMobileMoney($reservationId)
{
    $reservation = Reservation::findOrFail($reservationId);
    return view('paiement.mobilemoney', compact('reservation'));
}

public function formBanque($reservationId)
{
    $reservation = Reservation::findOrFail($reservationId);
    return view('paiement.banque', compact('reservation'));
}

// TRAITEMENT du paiement Mobile Money
public function processMobileMoney(Request $request, $id)
{
    // Tu peux ajouter une vraie logique de retrait via API si dispo (ex: MTN MoMo)
    $paiement = Paiement::findOrFail($id);

    // Simule un paiement réussi
    $paiement->statut = 'payé';
    $paiement->save();

    return redirect()->route('merci.reservation')->with('success', 'Paiement Mobile Money effectué avec succès. Merci !');
}

// TRAITEMENT du paiement Banque
public function processBanque(Request $request, $id)
{
    $paiement = Paiement::findOrFail($id);

    // Simule un paiement bancaire validé
    $paiement->statut = 'payé';
    $paiement->save();

    return redirect()->route('merci.reservation')->with('success', 'Paiement par compte bancaire confirmé. Merci !');
}

}

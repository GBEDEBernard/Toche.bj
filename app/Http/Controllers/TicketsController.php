<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Evenement;

class TicketsController extends Controller
{
    // Affiche le formulaire de création groupée
    public function Create_ticket()
    {
        $evenements = Evenement::all();
        return view('Admin.Tickets.create', compact('evenements'));
    }

    // Traitement du formulaire groupé
    public function traitement_create_ticket(Request $request)
    {
        $request->validate([
            'evenement_id' => 'required|exists:evenements,id',
            'tickets' => 'required|array',
        ]);

        foreach ($request->tickets as $type => $data) {
            if (!empty($data['nombres']) && !empty($data['prix'])) {
                Ticket::create([
                    'evenement_id' => $request->evenement_id,
                    'type' => ucfirst($type), // Standard, Premium, VIP
                    'nombres' => $data['nombres'],
                    'prix' => $data['prix'],
                ]);
            }
        }

        return redirect()->route('indextickets')->with('success', 'Les tickets ont été enregistrés avec succès 🎟️');
    }

    // Liste des tickets
 public function ticket(Request $request)
{
    $query = Ticket::with('evenement');

    // Filtrage par événement
    if ($request->filled('evenement_id')) {
        $query->where('evenement_id', $request->evenement_id);
    }

    // Filtrage par type
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    $datas = $query->get();
    $evenements = \App\Models\Evenement::all();
    $types = ['Standard', 'Premium', 'VIP']; // tu peux ajouter d’autres types ici

    return view('Admin.Tickets.index', compact('datas', 'evenements', 'types'));
}

    // Modifier un ticket
    public function modifierticket($id)
{
    $data = Ticket::with('evenement')->findOrFail($id);
    return view('editTicket', compact('data'));
}


    // Traitement de la modification
    public function modificationticket(Request $request, $id)
    {
        $data = Ticket::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('indextickets')->with('success', 'Ticket modifié avec succès.');
    }

    // Suppression
    public function supressionticket($id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return back()->with('error', 'Ticket introuvable.');
        }

        $ticket->delete();
        return redirect()->route('indextickets')->with('success', 'Ticket supprimé avec succès.');
    }
}

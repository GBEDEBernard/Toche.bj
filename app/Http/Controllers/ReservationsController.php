<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Evenement;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Paiement;
use App\Models\PieceIdentite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReservationsController extends Controller
{
    /**
     * 🔒 PARTIE ADMIN – GESTION CRUD
     */

    public function index()
    {
        $datas = Reservation::all();
        return view('Admin.Reservations.index', compact('datas'));
    }

    public function create_reservations()
    {
        $evenements = Evenement::all();
        $users = User::all();
        $tickets = collect(); // Empty collection, tickets loaded dynamically
        $typesPaiement = ['Carte bancaire', 'Mobile Money', 'Espèces'];
        return view('Admin.Reservations.create', compact('evenements', 'users', 'tickets', 'typesPaiement'));
    }

    public function storeAdmin(Request $request)
    {
        Log::info('storeAdmin called', [
            'user_id' => Auth::id(),
            'permissions' => Auth::user()->getAllPermissions()->pluck('name'),
            'has_reservations_store' => Auth::user()->hasPermissionTo('reservations.store'),
        ]);

        $request->validate([
            'evenement_id' => 'required|exists:evenements,id',
            'user_id' => 'required|exists:users,id',
            'ticket_id' => [
                'required',
                'exists:tickets,id',
                function ($attribute, $value, $fail) use ($request) {
                    $ticket = Ticket::find($value);
                    if ($ticket && $ticket->evenement_id != $request->evenement_id) {
                        $fail('Le ticket sélectionné n\'appartient pas à l\'événement choisi.');
                    }
                },
            ],
            'nombre_personnes' => 'required|integer|min:1',
            'type_paiement' => 'required|string',
            'date' => 'required|date',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        if ($ticket->nombres < $request->nombre_personnes) {
            return back()->withErrors(['nombre_personnes' => 'Nombre de personnes dépasse les tickets disponibles.']);
        }
        $montant = $ticket->prix * $request->nombre_personnes;

        Reservation::create([
            'evenement_id' => $request->evenement_id,
            'user_id' => $request->user_id,
            'ticket_id' => $request->ticket_id,
            'nombre_personnes' => $request->nombre_personnes,
            'montant' => $montant,
            'type_paiement' => $request->type_paiement,
            'date' => $request->date,
        ]);

        return redirect()->route('admin.reservations.index')->with('success', 'Réservation créée avec succès !');
    }

    public function edit($id)
    {
        $data = Reservation::findOrFail($id);
        $evenements = Evenement::all();
        $users = User::all();
        $tickets = Ticket::where('evenement_id', $data->evenement_id)->get();
        $typesPaiement = ['Carte bancaire', 'Mobile Money', 'Espèces'];
        return view('Admin.Reservations.edit', compact('data', 'evenements', 'users', 'tickets', 'typesPaiement'));
    }

    public function update(Request $request, $id)
    {
        $data = Reservation::findOrFail($id);

        $request->validate([
            'evenement_id' => 'required|exists:evenements,id',
            'user_id' => 'required|exists:users,id',
            'ticket_id' => [
                'required',
                'exists:tickets,id',
                function ($attribute, $value, $fail) use ($request) {
                    $ticket = Ticket::find($value);
                    if ($ticket && $ticket->evenement_id != $request->evenement_id) {
                        $fail('Le ticket sélectionné n\'appartient pas à l\'événement choisi.');
                    }
                },
            ],
            'nombre_personnes' => 'required|integer|min:1',
            'type_paiement' => 'required|string',
            'date' => 'required|date',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        if ($ticket->nombres < $request->nombre_personnes) {
            return back()->withErrors(['nombre_personnes' => 'Nombre de personnes dépasse les tickets disponibles.']);
        }
        $montant = $ticket->prix * $request->nombre_personnes;

        $data->update([
            'evenement_id' => $request->evenement_id,
            'user_id' => $request->user_id,
            'ticket_id' => $request->ticket_id,
            'nombre_personnes' => $request->nombre_personnes,
            'type_paiement' => $request->type_paiement,
            'date' => $request->date,
        ]);

        return redirect()->route('admin.reservations.index')->with('success', 'Réservation modifiée avec succès !');
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return back()->with('error', 'Réservation introuvable.');
        }
        $reservation->paiement()->delete();
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('success', 'Réservation supprimée.');
    }

    /**
     * 🌐 PARTIE PUBLIQUE – RÉSERVATION USER
     */

    public function showReservationForm($evenement_id)
    {
        $evenement = Evenement::findOrFail($evenement_id);
        $tickets = Ticket::where('evenement_id', $evenement_id)->get();
        $user = Auth::user();
        $pieces_identites = $user ? $user->pieceIdentite()->first() : null;
        $typesPaiement = ['Carte bancaire', 'Mobile Money', 'Espèces'];
        return view('Public.Reservation.create', compact('evenement', 'tickets', 'typesPaiement', 'user', 'pieces_identites'));
    }

//les controleur de payement
public function store(Request $request)
{
    $validated = $request->validate([
        'evenement_id' => 'required|exists:evenements,id',
        'ticket_id' => 'required|exists:tickets,id',
        'nombre_personnes' => 'required|integer|min:1',
        'type_piece' => 'required|string',
        'numero_piece' => 'required|string',
        'type_paiement' => 'required|in:Carte bancaire,Mobile Money,Espèces',
        'date' => 'required|date',
    ]);

    $user = Auth::user();

    // Vérifie ticket dispo (déjà bien géré côté JS mais c’est mieux de revalider ici)
    $ticket = Ticket::findOrFail($validated['ticket_id']);
    if ($validated['nombre_personnes'] > $ticket->nombres) {
        return back()->withErrors(['nombre_personnes' => 'Nombre de personnes dépasse les tickets disponibles.']);
    }

    // Enregistrer la pièce d'identité si pas encore existante
    $piece = PieceIdentite::firstOrCreate(
        ['user_id' => $user->id],
        ['type' => $validated['type_piece'], 'numero' => $validated['numero_piece']]
    );

    // Créer la réservation
    $reservation = Reservation::create([
        'evenement_id' => $validated['evenement_id'],
        'user_id' => $user->id,
        'ticket_id' => $validated['ticket_id'],
        'nombre_personnes' => $validated['nombre_personnes'],
        'montant' => $ticket->prix * $validated['nombre_personnes'],
        'type_paiement' => $validated['type_paiement'],
        'date' => $validated['date'],
    ]);

    // Créer le paiement
    $paiement = Paiement::create([
        'reservation_id' => $reservation->id,
        'montant' => $reservation->montant,
        'type_paiement' => $reservation->type_paiement,
        'mode' => strtolower($reservation->type_paiement), // par exemple : "mobile money"
        'reference' => uniqid('PMT_'), // ou tout autre identifiant unique
        'date_paiement' => now(), // ou la date réelle du paiement
        'statut' => 'en_attente',
    ]);
    

    // 🔁 Redirection selon le type de paiement
    if ($validated['type_paiement'] === 'Mobile Money') {
        return redirect()->route('paiement.mobile', ['id' => $paiement->id]);
    } elseif ($validated['type_paiement'] === 'Carte bancaire') {
        return redirect()->route('paiement.banque', ['id' => $paiement->id]);
    }

    // Sinon, message pour les espèces
    return redirect()->route('merci.reservation')->with('success', 'Réservation enregistrée avec succès. Paiement à faire sur place.');
}
        

    
        public function mobileMoney($reservationId)
        {
            $reservation = Reservation::findOrFail($reservationId);
            return view('paiement.mobilemoney', compact('reservation'));
        }
    
        public function banque($reservationId)
        {
            $reservation = Reservation::findOrFail($reservationId);
            return view('paiement.banque', compact('reservation'));
        }
    
    
    public function getTicketsByEvenement($evenement_id)
    {
        return Ticket::where('evenement_id', $evenement_id)->get(['id', 'type', 'prix']);
    }

    public function getTicketAvailability($ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);
        return response()->json(['nombres' => $ticket->nombres]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Evenement;
use App\Models\User;

class ReservationsController extends Controller
{
   public function index()
   {
       return view('participer'); // Assure-toi que la vue 'participer.blade.php' existe
   }
   

    // Affiche le formulaire de création d'une réservation
    public function create_reservation()
    {
        // Récupère les événements et utilisateurs pour remplir le formulaire
        $evenements = Evenement::all();
        $users = User::all();
        
        return view('Admin/Reservations/create', compact('evenements', 'users'));
    }

    // Traite la création de la réservation
    public function traitement_create_reservation(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'evenement_id' => 'required|exists:evenements,id', // Vérifie que l'événement existe
            'users_id' => 'required|exists:users,id',           // Vérifie que l'utilisateur existe
            'nombre' => 'required|integer|min:1',               // Validation de nombre positif
            'prix' => 'required|numeric|min:0',                  // Validation du prix
            'date' => 'required|date',                           // Validation de la date
        ]);

        // Crée une nouvelle réservation
        Reservation::create($request->all());

        // Redirige vers la page des réservations après la création
        return redirect()->route('indexreservations')->with('success', 'Réservation créée avec succès!');
    }

    // Affiche la liste des réservations
    public function reservations()
    {
        // Récupère toutes les réservations
        $datas = Reservation::all();

        // Renvoie la vue avec les données des réservations
        return view('Admin/Reservations/index', compact('datas'));
    }

    // Affiche le formulaire de modification d'une réservation
    public function modifierreservation($id)
    {
        // Récupère la réservation à modifier
        $data = Reservation::findOrFail($id);

        // Renvoie la vue avec les données de la réservation
        return view('Admin/modification/editreservation', compact('data'));
    }

    // Traite la modification d'une réservation
    public function modificationreservation(Request $request, $id)
    {
        // Récupère la réservation existante
        $data = Reservation::findOrFail($id);

        // Met à jour les données de la réservation
        $data->update($request->all());

        // Redirige vers la page des réservations avec un message de succès
        return redirect()->route('indexreservations')->with('success', 'Réservation modifiée avec succès!');
    }

    // Supprime une réservation
    public function destroyReservation($id)
    {
        // Recherche la réservation à supprimer
        $reservation = Reservation::findOrFail($id);

        // Supprime la réservation
        $reservation->delete();

        // Redirige vers la liste des réservations avec un message de succès
        return redirect()->route('indexreservations')->with('success', 'Réservation supprimée avec succès!');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Mail\DemandeReponseMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


class DemandeParticipation extends Model
{
    use HasFactory;

    protected $fillable = [
        'itineraire_id',
        'nom',
        'telephone',
        'email',
        'message',
        'reponse'
    ];

    public function itineraire()
    {
        return $this->belongsTo(Itineraire::class);
    }

  

public function repondre(Request $request, $id)
{
    $demande = DemandeParticipation::findOrFail($id);

    $request->validate([
        'message' => 'required|string|max:1000',
    ]);

    // Envoi de l'email
    Mail::to($demande->email)->send(new DemandeReponseMail(
        $demande->nom,
        $request->message,
        $demande->itineraire
    ));

    return back()->with('success', 'Réponse envoyée avec succès à ' . $demande->email);
}

}


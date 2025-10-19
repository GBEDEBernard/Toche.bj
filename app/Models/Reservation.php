<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'evenement_id',
        'user_id',
        'ticket_id',
        'nombre_personnes',
        'montant',
        'type_paiement',
        'date',
    ];

    

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}
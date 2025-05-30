<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'montant',
        'type_paiement',
        'mode',
        'reference',
        'date_paiement',
        'statut',
    ];

    protected $casts = [
        'date_paiement' => 'datetime',
    ];

    // 🔁 Relation avec Reservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}

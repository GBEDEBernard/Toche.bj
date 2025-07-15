<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Itineraire extends Model
{
    protected $fillable = [
        'agence_id',
        'titre',
        'description',
        'duree',
        'prix_estime',
        'date_depart',
        'date_retour',
        'niveau_difficulte',
    ];

    protected $casts = [
        'date_depart' => 'date',
        'date_retour' => 'date',
    ];
    public function agence(): BelongsTo
    {
        return $this->belongsTo(AgenceVoyage::class);
    }

    public function site_touristiques(): BelongsToMany
    {
        return $this->belongsToMany(Site_touristique::class, 'itineraire_sites')
                    ->withPivot('ordre', 'temps_prevu', 'commentaire')
                    ->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItineraireSite extends Model
{
    protected $table = 'itineraire_sites';

    protected $fillable = [
        'itineraire_id',
        'site_touristique_id',
        'ordre',
        'temps_prevu',
        'commentaire',
    ];

    public function itineraire(): BelongsTo
    {
        return $this->belongsTo(Itineraire::class);
    }

    public function site_touristique(): BelongsTo
    {
        return $this->belongsTo(Site_touristique::class);
    }
}

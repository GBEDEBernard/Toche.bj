<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgenceVoyage extends Model
{
    protected $fillable = [
        'user_id',
        'nom',
        'description',
        'contact',
        'photo',
        'adresse',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function itineraires(): HasMany
    {
        return $this->hasMany(Itineraire::class);
    }
}

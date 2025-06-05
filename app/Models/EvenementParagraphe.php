<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class EvenementParagraphe extends Model
{
    protected $fillable = ['evenement_id', 'titre', 'contenu', 'ordre'];

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }
}
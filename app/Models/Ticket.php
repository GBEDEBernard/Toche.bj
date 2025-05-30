<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['evenement_id', 'type', 'prix','nombres'];

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
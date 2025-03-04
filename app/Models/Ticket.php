<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'evenement_id',
        'type',
        'nombres',
        'prix',
    ];

     //cette method evenement veut dire qu'une ticket  est 
    //lié à un et un seul evenement 
     public function evenement():BelongsTo{
        return $this->belongsTo(Evenement::class );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'evenement_id',
        'users_id',
        'nombre',
        'prix',
        'date',

        
    ];

     //cette method user veut dire qu'une reservation  est 
    //lié à un et un seul utilisateur 
    public function user():BelongsTo{
        return $this->belongsTo(User::class );
    }
      //cette method evenement veut dire qu'une reservation  est 
    //lié à un et un seul evenement 
    public function evenement():BelongsTo{
        return $this->belongsTo(Evenement::class );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evenement extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'nom',
        'site_touristique_id',
        'lieu',
        'date',
        'photo',
        'sponsor',
        'description',
    ];

     //la méthods reservations  pour declarer qu'un evenement 
    //  peut faire 1 où plusieurs reservations
    public function  reservations():HasMany{
        return $this->hasMany(Reservation::class);
    }
      //la méthods Tickets  pour declarer qu'un evenement 
    //  peut avoir 1 où plusieurs ticket
    public function  tickets():HasMany{
        return $this->hasMany(Ticket::class);
    }
     //la méthods galeries  pour declarer qu'un evenement 
    //  peut avoir 1 où plusieurs photo
    public function  galeries():HasMany{
        return $this->hasMany(Galerie::class);
    }
    //cette method site_touristique veut dire qu'une evenemennt  est 
    //lié à un et un seul site_touristique 
    public function site_touristique():BelongsTo{
        return $this->belongsTo(Site_touristique::class );
    }
}

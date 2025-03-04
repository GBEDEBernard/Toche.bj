<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Galerie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'photo',
        
    ];

     //cette method evenement veut dire qu'une galerie  est 
    //lié à un et un seul evenement 
    public function evenement():BelongsTo{
        return $this->belongsTo(Evenement::class );
    }

     //cette method site_touristique veut dire qu'une galerie  est 
    //lié à un et un seul site_touristique 
    public function site_touristique():BelongsTo{
        return $this->belongsTo(Site_touristique::class );
    }
}

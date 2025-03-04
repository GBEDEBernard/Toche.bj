<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Visite extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_touristique_id',
        'users_id',
        'telephone',
        'nombre',
        'prix',
        'date',
        'chemin_ticket',
    ];
     //cette method site_touristique veut dire une visite est 
    //lié à un et un seul site-touristique 
    public function site_touristique():BelongsTo{
        return $this->belongsTo(Site_touristique::class );
    }
    //cette method user veut dire une visite est 
    //lié à un et un seul utilisateurs
    public function user():BelongsTo{
        return $this->belongsTo(User::class );
    }
    
}

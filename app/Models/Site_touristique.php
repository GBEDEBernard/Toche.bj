<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site_touristique extends Model
{
    use HasFactory;
    protected $fillable = [
        'categorie_id',
        'nom',
        'pays',
        'departement',
        'commune',
        'email',
        'photo',
        'contact',
        'description',
        
    ];
    //cette method catégorie veut dire un site touristique est 
    //lié à un et un seul catégorie 
    public function categorie():BelongsTo{
        return $this->belongsTo(Categorie::class );
    }
    //la méthods visites  pour declarer qu'une 
    //site_touristiques  peut avoir 1 où plusieurs visite
    public function  visites():HasMany{
        return $this->hasMany(Visite::class);
    }
     //la méthods galeries  pour declarer qu'une 
    //site_touristiques  peut avoir 1 où plusieurs photo
    public function  galeries():HasMany{
        return $this->hasMany(Galerie::class);
    }
       //la méthods evenements  pour declarer qu'une 
    //site_touristiques  peut avoir 1 où plusieurs evenements
    public function  evenements():HasMany{
        return $this->hasMany(Evenement::class);
    }
    //la méthods avis  pour declarer qu'un utilisateur (user)
    //  peut donner 1 où plusieurs avis
    public function  avis():HasMany{
        return $this->hasMany(Avi::class);
    }

}

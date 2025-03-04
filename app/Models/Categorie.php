<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'types',
        
    ];
    //la méthods site_touristique pour declarer qu'une 
    //catégorie peut avoir 1 où plusieurs sites touristiques
    public function  site_touristiques():HasMany{
        return $this->hasMany(Site_touristique::class);
    }
}

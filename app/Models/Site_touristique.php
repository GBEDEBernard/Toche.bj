<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property int|null $categorie_id
 * @property string $nom
 * @property string $pays
 * @property string $departement
 * @property string $commune
 * @property string $email
 * @property string $photo
 * @property string $contact
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Avi> $avis
 * @property-read int|null $avis_count
 * @property-read \App\Models\Categorie|null $categorie
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Evenement> $evenements
 * @property-read int|null $evenements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Galerie> $galeries
 * @property-read int|null $galeries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Visite> $visites
 * @property-read int|null $visites_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereCategorieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereCommune($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereDepartement($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique wherePays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        // POUR LA LOCALISATION
        'adresse', // Nouveau
        'latitude', // Nouveau
        'longitude', // Nouveau
        
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
    
    //relation des commentaire
    public function commentaires() {
        return $this->hasMany(Commentaire::class);
    }
    
    public function avis()
    {
        return $this->morphMany(Avis::class, 'avisable')->where('statut', 'approuvé');
    }
    
// Affiche tous les avis, utile pour l'utilisateur connecté
public function tousLesAvis() {
    return $this->morphMany(Avis::class, 'avisable');
}

public function details()
{
    return $this->hasMany(SiteDetail::class)->orderBy('ordre');
}


}

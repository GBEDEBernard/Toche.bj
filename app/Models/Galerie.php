<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * 
 *
 * @property int $id
 * @property int $site_touristique_id
 * @property int $evenement_id
 * @property string $nom
 * @property string $photo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Evenement $evenement
 * @property-read \App\Models\Site_touristique $site_touristique
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie whereEvenementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie whereSiteTouristiqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Galerie extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_touristique_id',
        'evenement_id',
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

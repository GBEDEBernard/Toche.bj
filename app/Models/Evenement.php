<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $site_touristique_id
 * @property string $nom
 * @property string $lieu
 * @property string $date
 * @property string $photo
 * @property string $sponsor
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Galerie> $galeries
 * @property-read int|null $galeries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @property-read \App\Models\Site_touristique $site_touristique
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket> $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereLieu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereSiteTouristiqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereSponsor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

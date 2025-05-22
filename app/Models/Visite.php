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
 * @property int $users_id
 * @property int $telephone
 * @property int $nombre
 * @property int $prix
 * @property string $date
 * @property string $chemin_ticket
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Site_touristique $site_touristique
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereCheminTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereSiteTouristiqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereUsersId($value)
 * @mixin \Eloquent
 */
class Visite extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_touristique_id',
        'user_id',
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
    public function user()
{
    return $this->belongsTo(User::class);
}
    
}

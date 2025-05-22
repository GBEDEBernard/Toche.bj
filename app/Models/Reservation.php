<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $evenement_id
 * @property int $users_id
 * @property int $nombre
 * @property int $prix
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Evenement $evenement
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereEvenementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUsersId($value)
 * @mixin \Eloquent
 */
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
        return $this->belongsTo(User::class, 'users_id');
    }
      //cette method evenement veut dire qu'une reservation  est 
    //lié à un et un seul evenement 
    public function evenement():BelongsTo{
        return $this->belongsTo(Evenement::class, 'evenement_id');
    }
}
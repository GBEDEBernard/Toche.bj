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
 * @property string $type
 * @property int $nombres
 * @property string $prix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Evenement $evenement
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereEvenementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'evenement_id',
        'type',
        'nombres',
        'prix',
    ];

     //cette method evenement veut dire qu'une ticket  est 
    //lié à un et un seul evenement 
     public function evenement():BelongsTo{
        return $this->belongsTo(Evenement::class );
    }
}

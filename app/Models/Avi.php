<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * 
 *
 * @property int $id
 * @property int $users_id
 * @property int $site_touristique_id
 * @property string $message
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Site_touristique|null $site_touristiques
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereSiteTouristiqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereUsersId($value)
 * @mixin \Eloquent
 */
class Avi extends Model
{
    use HasFactory;
    protected $fillable = [
        'users-id',
        'site_touristique_id',
        'message',
        'date',
       
    ];

    //cette method user veut dire un avi  est 
    //lié à un et un seul utilisateur 
    public function user():BelongsTo{
        return $this->belongsTo(User::class );
    }
    //cette method user veut dire un avi  est 
    //lié à un et un site
    public function site_touristiques():BelongsTo{
        return $this->belongsTo(Site_touristique::class );
    }
}

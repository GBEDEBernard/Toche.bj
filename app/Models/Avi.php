<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


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

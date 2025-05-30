<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PieceIdentite extends Model
{
    protected $table = 'pieces_identites';

    // ✅ Ces noms doivent correspondre exactement aux colonnes de ta table
    protected $fillable = [
        'user_id',
        'type',
        'numero',
        'date_expiration',
        'scan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

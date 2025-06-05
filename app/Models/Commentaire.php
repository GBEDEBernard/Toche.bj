<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Evenement;
use App\Models\Site_Touristique;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenu',
        'user_id',
        'evenement_id',
        'site_touristique_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function evenement() {
        return $this->belongsTo(Evenement::class);
    }

    public function site_touristique() {
        return $this->belongsTo(Site_Touristique::class);
    }
}

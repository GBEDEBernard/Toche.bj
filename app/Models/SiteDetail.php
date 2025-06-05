<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteDetail extends Model
{
    protected $fillable = [
        'site_touristique_id', 
        'titre',
         'contenu',
         'ordre',
        ];

    public function site_touristique()
    {
        return $this->belongsTo(Site_Touristique::class);
    }
}

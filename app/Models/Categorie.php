<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
   class Categorie extends Model
   {
       protected $fillable = ['types'];

       /**
        * Get the tourist sites associated with this category.
        */
       public function sites()
       {
           return $this->hasMany(Site_touristique::class, 'categorie_id');
       }
   }

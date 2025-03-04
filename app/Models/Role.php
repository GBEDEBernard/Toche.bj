<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nom',
        
    ];
   
       //la méthods users  pour declarer qu'un utilisateur (user)
      //  peut avoir 1 où plusieurs Roles
       public function  users():HasMany{
        return $this->hasMany(User::class);
    }
   
}

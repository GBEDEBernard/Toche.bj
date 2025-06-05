<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avis extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avisable_id',
        'avisable_type',
        'commentaire',
        'note',
        'statut',
        'parent_id',
        'reponse',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function avisable()
    {
        return $this->morphTo(); // polymorphisme avec Evenement, SiteTouristique, etc.
    }

    public function parent()
    {
        return $this->belongsTo(Avis::class, 'parent_id');
    }

    public function enfants()
    {
        return $this->hasMany(Avis::class, 'parent_id');
    }

    public function reponses()
    {
        return $this->hasMany(Avis::class, 'parent_id');
    }
}

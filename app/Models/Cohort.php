<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    // Nom de la table associée au modèle (optionnel si le nom suit la convention Laravel)
    protected $table = 'cohorts';

    // Champs autorisés à être remplis en masse (ex: lors d'une création ou d'une mise à jour)
    protected $fillable = ['school_id', 'name', 'description', 'start_date', 'end_date'];

    // Relation many-to-many entre Cohort et User via la table pivot 'cohort_user'
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'cohort_user'); // Une promotion peut avoir plusieurs enseignants
    }

    // Relation one-to-many : une promotion peut avoir plusieurs rétrospectives (Retro)
    public function retros()
    {
        return $this->hasMany(Retro::class); // Une promo est liée à plusieurs rétrospectives
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReglementationAutorisation extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [

        "authorisation_service",
        "etablissement_id"
    ];
    
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id', 'id');
    }
}
// http://192.168.1.100:8000/api/alerte/new?user_id=1&level_urgence=4&nom_user=dsfdfddf&speciality=[1,2,3]&phone_user=690863838&birthday_user=10/01/1998&poids_user=81.5&taille_user=1.5&email_user=ffddffddf&ville_user=fddffd&sexe_user=fdf

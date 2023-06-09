<?php

namespace App\Models;

use App\Models\SpecialiteAlerte;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alerte extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alertes';


    protected $fillable = [
        "user_id",
        "name_user",

        // "birthday_user",
        // 'poids_user',
        // "taille_user",
        "email_user",
        "etablissement_id",
        "niveau_urgence",
        "description",
        "ville",
        "longitude",
        "latitude",
        // "sexe_user"
    ];

    public function SpecialiteAlerte()
    {
        return $this->hasMany(SpecialiteAlerte::class, 'alerte_id');
    }
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id', 'id');
    }

    public function specialites(){
        return $this->belongsToMany(Specialite::class, SpecialiteAlerte::class);
    }
}

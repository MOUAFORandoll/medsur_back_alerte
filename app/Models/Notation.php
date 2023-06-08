<?php

namespace App\Models;

use App\Models\Etablissement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "user_id",
        "etablissement_id",
        "qualite_soins",
        "temps_attente",
        "disponibilite_medicaments",
        "examens",
        "comprehension_soins_administres",
        "resolution_probleme",
        "facture"
    ];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["libelle","libelle_en"];



    public function AgendaEtablissement()
    {
        return $this->hasMany(AgendaEtablissement::class, 'agenda_id');
    }

    public function etablissements(){
        return $this->belongsToMany(Etablissement::class, AgendaEtablissement::class);
    }
}

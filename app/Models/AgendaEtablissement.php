<?php

namespace App\Models;


use App\Models\Etablissement;
use App\Models\Specialite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgendaEtablissement extends Model
{
    use HasFactory, SoftDeletes;
    

    protected $fillable = [
        "agenda_id",
        "etablissement_id",
        "debut",
        "fin"
    ];
    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id', 'id');
    }
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id', 'id');
    }
}

<?php

namespace App\Models;


use App\Models\Etablissement;
use App\Models\Specialite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialiteEtablissement extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'specialite_etablissement';


    protected $fillable = [
        "specialite_id",
        "etablissement_id"
    ];
    public function specialiteetablissement()
    {
        return $this->belongsTo(Specialite::class, 'specialite_id', 'id');
    }
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id', 'id');
    }
}

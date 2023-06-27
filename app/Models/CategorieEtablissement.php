<?php

namespace App\Models;


use App\Models\Etablissement;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategorieEtablissement extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorie_etablissement';


    protected $fillable = [
        "categorie_id",
        "etablissement_id"
    ];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id', 'id');
    }
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id', 'id');
    }
}

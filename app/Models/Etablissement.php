<?php

namespace App\Models;

use App\Models\AgendaEtablissement;
use App\Models\SpecialiteEtablissement;
use Carbon\Carbon;
use App\Models\Assistante;
use App\Models\Traits\SlugRoutable;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\RestrictEtablissementScope;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Netpok\Database\Support\RestrictSoftDeletes;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Etablissement
 *
 */
class Etablissement extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'etablissements';

    protected $fillable = [
        "name",
        "name2",
        "siteweb",
        "code",
        "phone",
        "phone2",
        'email',
        "description",
        "localisation_id",
        "status",
        "user_id"

    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new RestrictEtablissementScope);
    }

    public function Notation()
    {
        return $this->hasMany(Notation::class, 'etablissement_id');
    }

    public function SpecialiteEtablissement()
    {

        return  $this->hasMany(SpecialiteEtablissement::class, 'etablissement_id')->with(['Specialite',]);
    }


    public function specialites()
    {
        return $this->belongsToMany(Specialite::class, SpecialiteEtablissement::class);
    }
    public function garanti()
    {
        return $this->hasMany(Garanti::class, 'etablissement_id');
    }
    public function alerte()
    {
        return $this->hasMany(Alerte::class, 'etablissement_id');
    }
    public function reglementationAutorisation()
    {
        return $this->hasMany(ReglementationAutorisation::class, 'etablissement_id');
    }
    public function AgendaEtablissement()
    {
        return $this->hasMany(AgendaEtablissement::class, 'etablissement_id');
    }


    public function localisation()
    {
        return $this->belongsTo(Localisation::class, 'localisation_id', 'id');
    }
    public function agendas()
    {
        return $this->belongsToMany(Agenda::class, AgendaEtablissement::class)
            ->withPivot(["fin",  "debut", 'id']);
    }
    public function CategorieEtablissement()
    {

        return  $this->hasMany(CategorieEtablissement::class, 'etablissement_id')->with(['Categorie',]);
    }


    public function categories()
    {
        return $this->belongsToMany(Categorie::class, CategorieEtablissement::class);
    }
}

<?php

namespace App\Models;


use App\Models\Alerte;
use App\Models\Etablissement;
use App\Models\Specialite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialiteAlerte extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'specialite_alerte';


    protected $fillable = [
        "specialite_id",
        "alerte_id"
    ];
    public function specialitealerte()
    {
        return $this->belongsTo(Specialite::class, 'specialite_id', 'id');
    }
    public function alerte()
    {
        return $this->belongsTo(Alerte::class, 'alerte_id', 'id');
    }
}

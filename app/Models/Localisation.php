<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localisation extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * The table associated with the model.
     *localisations
     * @var string
     */
    protected $table = 'localisations';
    protected $fillable = [
        "longitude",
        "latitude",
        "boite_postale",
        "pays",
        "ville",
        "rue",
        "description",
    

    ];
    public function etablissement()
    {
        return $this->hasMany(Etablissement::class, 'localisation_id');
    }
}

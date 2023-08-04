<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialite extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "libelle",
        "libelle_en"
    ];
    public function SpecialiteEtablissement()
    {
        return $this->hasMany(SpecialiteEtablissement::class, 'specialite_id');
    }
    public function SpecialiteAlerte()
    {
        return $this->hasMany(SpecialiteAlerte::class, 'specialite_id');
    }
}

<?php

namespace App\Models;


use App\Models\Etablissement;
use App\Models\Specialite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandeActivationEtablissement extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [

        "etablissement_id"
    ];
}

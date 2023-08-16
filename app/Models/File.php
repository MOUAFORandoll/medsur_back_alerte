<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;


    protected $fillable = ['name', 'path'];


    public function etablissement()
    {
        return $this->hasMany(Etablissement::class, 'localisation_id');
    }
}

<?php

namespace Database\Factories;

use App\Models\Etablissement;
use App\Models\Specialite;
use App\Models\SpecialiteEtablissement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecialiteEtablissement>
 */
class SpecialiteEtablissementFactory extends Factory
{
   
    public function definition(): array
    {

        $etablissement = Etablissement::inRandomOrder()->limit(1)->first();
        $specialite = Specialite::inRandomOrder()->limit(1)->first();

        $exist = SpecialiteEtablissement::where('specialite_id', $specialite->id)
            ->where('etablissement_id', $etablissement->id,)
            ->get();
        return
            count($exist) == 0 ? [
                "specialite_id"
                => $specialite->id,
                "etablissement_id" =>
                $etablissement->id,
            ] : null;
    }
}

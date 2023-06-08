<?php

namespace Database\Factories;

use App\Models\Etablissement;
use App\Models\Specialite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecialiteEtablissement>
 */
class SpecialiteEtablissementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $etablissement = Etablissement::inRandomOrder()->limit(1)->first();
        $specialite = Specialite::inRandomOrder()->limit(1)->first();
        return [
            "specialite_id"
            => $specialite->id,
            "etablissement_id" =>
            $etablissement->id,
        ];
    }
}

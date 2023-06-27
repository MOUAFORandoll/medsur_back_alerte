<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\CategorieEtablissement;
use App\Models\Etablissement;
use App\Models\Specialite;
use App\Models\SpecialiteEtablissement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecialiteEtablissement>
 */
class CategorieEtablissementFactory extends Factory
{

    public function definition(): array
    {



        $etablissement = Etablissement::inRandomOrder()->limit(1)->first();
        $categorie = Categorie::inRandomOrder()->limit(1)->first();

        $exist = CategorieEtablissement::where('categorie_id', $categorie->id,)
            ->where('etablissement_id', $etablissement->id,)
            ->get();
        if ($exist->count() == 0) {
            var_dump(count($exist));
            var_dump('--->->->----------->-->');
            var_dump([
                "categorie_id"
                =>
                $categorie->id,
                "etablissement_id" =>
                $etablissement->id,
            ]);
            return
                [
                    "categorie_id"
                    =>
                    $categorie->id,
                    "etablissement_id" =>
                    $etablissement->id,
                ];
        } else {
            return    $this->find();
        }
    }
}

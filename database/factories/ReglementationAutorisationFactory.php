<?php

namespace Database\Factories;

use App\Models\Etablissement;
use App\Models\ReglementationAutorisation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReglementationAutorisationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReglementationAutorisation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //$etablissement = Etablissement::inRandomOrder()->limit(1)->first();
        return [
            "authorisation_creation"  => $this->faker->boolean(),
            "authorisation_ouverture" => $this->faker->boolean(),
            "authorisation_service" => $this->faker->boolean(),
            "etablissement_id" => random_int(1, 50)
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Etablissement;
use App\Models\Garanti;
use Illuminate\Database\Eloquent\Factories\Factory;

class GarantiFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Garanti::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //$etablissement = Etablissement::inRandomOrder()->limit(1)->first();
        return [
            "arcce" => $this->faker->boolean(),
            "etablissement_id" => random_int(1, 20),
            "extra" => $this->faker->text()
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Localisation;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocalisationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Localisation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "longitude" => $this->faker->longitude(),
            "latitude" => $this->faker->latitude(),
            "boite_postale" => $this->faker->postcode(),
            "pays" => $this->faker->country(),
            "ville" => $this->faker->city(),
            "rue" => $this->faker->address(),
            "description" => $this->faker->text()
        ];
    }
}

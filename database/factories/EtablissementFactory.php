<?php

namespace Database\Factories;

use App\Models\Etablissement;
use App\Models\Localisation;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtablissementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Etablissement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //$localisation = Localisation::inRandomOrder()->limit(1)->first();

        return [
            "name" => $this->faker->name(),
            "name2" => $this->faker->name(),
            "siteweb" => $this->faker->url(),
            "code" => $this->faker->countryCode(),
            "phone" => $this->faker->phoneNumber(),
            "phone2" => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            "description" => $this->faker->text(),
            "localisation_id" => random_int(1, 50) //$localisation->id
        ];
    }
}

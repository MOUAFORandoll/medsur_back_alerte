<?php

namespace Database\Factories;

use App\Models\Alerte;
use App\Models\Specialite;
use App\Models\SpecialiteAlerte;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialiteAlerteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecialiteAlerte::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /* $alerte = Alerte::inRandomOrder()->limit(1)->first();
        $specialite = Specialite::inRandomOrder()->limit(1)->first(); */
        return ["specialite_id" => random_int(1, 50), "alerte_id" => random_int(1, 50)];
    }
}

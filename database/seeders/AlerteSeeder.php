<?php

namespace Database\Seeders;

use App\Models\Alerte;
use Illuminate\Database\Seeder;

class AlerteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alertes = Alerte::factory()->count(50)->create();
    }
}

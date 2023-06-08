<?php

namespace Database\Seeders;

use App\Models\Garanti;
use Illuminate\Database\Seeder;

class GarantiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $garantis = Garanti::factory()->count(50)->create();
    }
}

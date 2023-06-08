<?php

namespace Database\Seeders;

use App\Models\Notation;
use Illuminate\Database\Seeder;

class NotationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notations = Notation::factory()->count(50)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Petition;
use Database\Factories\PetitionFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      Petition::factory(50)->create();
    }
}

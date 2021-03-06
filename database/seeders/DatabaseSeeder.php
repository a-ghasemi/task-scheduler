<?php

namespace Database\Seeders;

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
        (new AdminSeeder())->run();
        (new DevelopersSeeder())->run();
        (new ProvidersSeeder())->run();
    }
}

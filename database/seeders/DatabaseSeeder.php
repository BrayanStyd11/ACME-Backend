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
        /**
         * Se crean Seeder base para tener información de ayuda en la base de datos
         */
        $this->call([
            RolesSeeder::class,
            VehiclesSeeder::class,
        ]);
    }
}

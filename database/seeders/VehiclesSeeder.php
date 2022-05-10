<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->insert([
            "plate" => "LQM 024",
            "color" => "Blanco",
            "brand" => "Nizan",
            "type"  => "Publico"
        ]);

        DB::table('vehicles')->insert([
            "plate" => "KCB 472",
            "color" => "Negro",
            "brand" => "Mercedes Benz",
            "type"  =>  "Privado",
        ]);
    }
}

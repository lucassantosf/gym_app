<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planos')->insert([
            'name' => 'Plano Simples', 
        ]);

        DB::table('planos')->insert([
            'name' => 'Plano Completo', 
        ]);

        DB::table('planos')->insert([
            'name' => 'Plano Musculação', 
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalidadePlanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modalidades_planos')->insert([
            'plano_id' => 1, 
            'modal_id' => 1,             
        ]);

        DB::table('modalidades_planos')->insert([
            'plano_id' => 2, 
            'modal_id' => 1,             
        ]); 

        DB::table('modalidades_planos')->insert([
            'plano_id' => 2, 
            'modal_id' => 2,             
        ]);

        DB::table('modalidades_planos')->insert([
            'plano_id' => 2, 
            'modal_id' => 3,             
        ]);

        DB::table('modalidades_planos')->insert([
            'plano_id' => 2, 
            'modal_id' => 4,             
        ]);

        DB::table('modalidades_planos')->insert([
            'plano_id' => 2, 
            'modal_id' => 5,             
        ]);

        DB::table('modalidades_planos')->insert([
            'plano_id' => 3, 
            'modal_id' => 1,             
        ]);

        DB::table('modalidades_planos')->insert([
            'plano_id' => 3, 
            'modal_id' => 2,             
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DuracaoPlanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('duracoes_planos')->insert([
            'plano_id' => 1,
            'duracao' => 1,
        ]);

        DB::table('duracoes_planos')->insert([
            'plano_id' => 2,
            'duracao' => 1,
        ]);

        DB::table('duracoes_planos')->insert([
            'plano_id' => 2,
            'duracao' => 3,
        ]);

        DB::table('duracoes_planos')->insert([
            'plano_id' => 2,
            'duracao' => 6,
        ]);

        DB::table('duracoes_planos')->insert([
            'plano_id' => 2,
            'duracao' => 9,
        ]);

        DB::table('duracoes_planos')->insert([
            'plano_id' => 2,
            'duracao' => 12,
        ]);

        DB::table('duracoes_planos')->insert([
            'plano_id' => 3,
            'duracao' => 1,
        ]);

        DB::table('duracoes_planos')->insert([
            'plano_id' => 3,
            'duracao' => 3,
        ]);

        DB::table('duracoes_planos')->insert([
            'plano_id' => 3,
            'duracao' => 12,
        ]);
    } 
}

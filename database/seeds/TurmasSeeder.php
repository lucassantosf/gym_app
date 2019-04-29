<?php

use Illuminate\Database\Seeder;

class TurmasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('turmas')->insert([
            'name' => 'Turma de Jump 1',
            'status' => 1,
            'modal_id' => 2, 
        ]);

        DB::table('turmas')->insert([
            'name' => 'Turma de Jump 2',
            'status' => 1,
            'modal_id' => 2, 
        ]);

        DB::table('turmas')->insert([
            'name' => 'Turma de Jump 3',
            'status' => 1,
            'modal_id' => 2, 
        ]); 

        DB::table('turmas')->insert([
            'name' => 'Turma de Dança 1',
            'status' => 1,
            'modal_id' => 3, 
        ]);

        DB::table('turmas')->insert([
            'name' => 'Turma de Dança 2',
            'status' => 1,
            'modal_id' => 3, 
        ]);

        DB::table('turmas')->insert([
            'name' => 'Turma de Dança 3',
            'status' => 1,
            'modal_id' => 3, 
        ]);
    }
}

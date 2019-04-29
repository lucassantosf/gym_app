<?php

use Illuminate\Database\Seeder;

class ItensTurmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_turmas')->insert([
            'hora_inicio' => '10:00',
            'hora_fim' => '10:59', 
            'dia_semana' => 2, 
            'status' => 1, 
            'vagas_livres' => 20, 
            'capacidade' => 20,  
            'turma_id' => 1, 
            'modal_id' => 2, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '11:00',
            'hora_fim' => '11:59', 
            'dia_semana' => 2, 
            'status' => 1, 
            'vagas_livres' => 30, 
            'capacidade' => 30, 
            'turma_id' => 1, 
            'modal_id' => 2, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '12:00',
            'hora_fim' => '12:59', 
            'dia_semana' => 2, 
            'status' => 1, 
            'vagas_livres' => 10, 
            'capacidade' => 10, 
            'turma_id' => 1, 
            'modal_id' => 2, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '13:00',
            'hora_fim' => '13:59', 
            'dia_semana' => 2, 
            'status' => 1, 
            'vagas_livres' => 10, 
            'capacidade' => 10, 
            'turma_id' => 1, 
            'modal_id' => 2, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '10:00',
            'hora_fim' => '10:59', 
            'dia_semana' => 3, 
            'status' => 1, 
            'vagas_livres' => 20, 
            'capacidade' => 20, 
            'turma_id' => 2, 
            'modal_id' => 2, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '11:00',
            'hora_fim' => '11:59', 
            'dia_semana' => 3, 
            'status' => 1, 
            'vagas_livres' => 30, 
            'capacidade' => 30, 
            'turma_id' => 2, 
            'modal_id' => 2, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '12:00',
            'hora_fim' => '12:59', 
            'dia_semana' => 3, 
            'status' => 1, 
            'vagas_livres' => 40, 
            'capacidade' => 40, 
            'turma_id' => 2, 
            'modal_id' => 2, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '13:00',
            'hora_fim' => '13:59', 
            'dia_semana' => 3, 
            'status' => 1, 
            'vagas_livres' => 50, 
            'capacidade' => 50, 
            'turma_id' => 2, 
            'modal_id' => 2, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '08:00',
            'hora_fim' => '08:59', 
            'dia_semana' => 4, 
            'status' => 1, 
            'vagas_livres' => 10, 
            'capacidade' => 10, 
            'turma_id' => 3, 
            'modal_id' => 2, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '09:00',
            'hora_fim' => '09:59', 
            'dia_semana' => 4, 
            'status' => 1, 
            'vagas_livres' => 10, 
            'capacidade' => 10, 
            'turma_id' => 3, 
            'modal_id' => 2, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '09:00',
            'hora_fim' => '09:59', 
            'dia_semana' => 1, 
            'status' => 1, 
            'vagas_livres' => 10, 
            'capacidade' => 10, 
            'turma_id' => 4, 
            'modal_id' => 3, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '10:00',
            'hora_fim' => '10:59', 
            'dia_semana' => 1, 
            'status' => 1, 
            'vagas_livres' => 10, 
            'capacidade' => 10, 
            'turma_id' => 4, 
            'modal_id' => 3, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '10:00',
            'hora_fim' => '10:59', 
            'dia_semana' => 2, 
            'status' => 1, 
            'vagas_livres' => 10, 
            'capacidade' => 10, 
            'turma_id' => 4, 
            'modal_id' => 3, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '10:00',
            'hora_fim' => '10:59', 
            'dia_semana' => 1, 
            'status' => 1, 
            'vagas_livres' => 10, 
            'capacidade' => 10, 
            'turma_id' => 5, 
            'modal_id' => 3, 
        ]);   

        DB::table('item_turmas')->insert([
            'hora_inicio' => '10:00',
            'hora_fim' => '10:59', 
            'dia_semana' => 2, 
            'status' => 1, 
            'vagas_livres' => 10, 
            'capacidade' => 10, 
            'turma_id' => 5, 
            'modal_id' => 3, 
        ]); 

        DB::table('item_turmas')->insert([
            'hora_inicio' => '10:00',
            'hora_fim' => '10:59', 
            'dia_semana' => 3, 
            'status' => 1, 
            'vagas_livres' => 10, 
            'capacidade' => 10, 
            'turma_id' => 5, 
            'modal_id' => 3, 
        ]);   

        DB::table('item_turmas')->insert([
            'hora_inicio' => '10:00',
            'hora_fim' => '10:59', 
            'dia_semana' => 1, 
            'status' => 1, 
            'vagas_livres' => 20, 
            'capacidade' => 20, 
            'turma_id' => 6, 
            'modal_id' => 3, 
        ]);  

        DB::table('item_turmas')->insert([
            'hora_inicio' => '10:00',
            'hora_fim' => '10:59', 
            'dia_semana' => 2, 
            'status' => 1, 
            'vagas_livres' => 20, 
            'capacidade' => 20, 
            'turma_id' => 6, 
            'modal_id' => 3, 
        ]); 

        DB::table('item_turmas')->insert([
            'hora_inicio' => '10:00',
            'hora_fim' => '10:59', 
            'dia_semana' => 3, 
            'status' => 1, 
            'vagas_livres' => 20, 
            'capacidade' => 20, 
            'turma_id' => 6, 
            'modal_id' => 3, 
        ]);   
    }
}

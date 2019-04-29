<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            'name' => 'Camisa Longa',
            'value' => 50,
            'controlEstoque' => 1,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Avaliacao Física',
            'value' => 100,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Avaliacao Dermatologica',
            'value' => 99,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Camisa Azul A',
            'value' => 30,
            'controlEstoque' => 1,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Camisa do time',
            'value' => 30,
            'controlEstoque' => 1,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Shorts P',
            'value' => 50,
            'controlEstoque' => 1,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Shorts M',
            'value' => 60,
            'controlEstoque' => 1,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Shorts G',
            'value' => 70,
            'controlEstoque' => 1,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Shorts GG',
            'value' => 80,
            'controlEstoque' => 1,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Refil café',
            'value' => 20,
            'controlEstoque' => 1,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Isotonico Classic GX',
            'value' => 10,
            'controlEstoque' => 1,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Isotonico Laranja',
            'value' => 10,
            'controlEstoque' => 1,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Isotonico Limão',
            'value' => 10,
            'controlEstoque' => 1,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Garrafinha',
            'value' => 5,
            'controlEstoque' => 1,
            'status' => 1,
        ]);

        DB::table('produtos')->insert([
            'name' => 'Massagem Tipo 2',
            'value' => 190,
            'status' => 1,
        ]);
    }
}

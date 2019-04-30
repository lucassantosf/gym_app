<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fornecedores')->insert([
            'name' => 'Confecção do Seu Alfres SMA',
            'email' => 'confecArts@gmail.com',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'Distribuidora de Proteinas RRQD LTDA',
            'email' => 'proteinAA@gmail.com',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'Forzens Artes e Design',
            'email' => 'forzens@hotmail.com',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'Juka e Jukens Livros e Pápeis',
            'email' => 'booksJuka@yahoo.com.br',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'Yaz add informática e Serviços',
            'email' => 'yaz_addinfo@bool.com',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'Booleans Trues and False LTDA',
            'email' => 'falsetrue@hotmail.com',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'Shorts e Cia Sorocabano',
            'email' => 'soroshorts@yahoo.com.br',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'Companhia de Café Itu LTDA',
            'email' => 'compcafeitu@gmail.com',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'ColorArt Publicações Sociais MFR',
            'email' => 'artpub@hotmail.com',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'Tintas Porcos e Castellos LTDA',
            'email' => 'tintas@globo.com',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'Kertyuio Papelaria Brasil',
            'email' => 'papelariak@yahoo.com.br',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'Roupas em Geral Companhia LA',
            'email' => 'companhiaLA@gmail.com',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'Folkes Distribuidora de Material Esportivo',
            'email' => 'Folkes@globo.com',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'Sheettes Equipamentos',
            'email' => 'Sheettes@gmail.com',
            'status' => 1,
        ]);

        DB::table('fornecedores')->insert([
            'name' => 'In your Way Bebidas e Materiais',
            'email' => 'bebidasWey@gmail.com',
            'status' => 1,
        ]);
    }
}

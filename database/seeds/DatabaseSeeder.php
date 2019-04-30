<?php

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
        $this->call([
            UsuariosSeeder::class,
            ModalidadeSeeder::class,
            ProdutosSeeder::class,
            ClientesSeeder::class,
            PlanosSeeder::class,
            DuracaoPlanoSeeder::class,
            ModalidadePlanoSeeder::class,
            TurmasSeeder::class,
            ItensTurmaSeeder::class,
            FornecedorSeeder::class,
        ]); 
    }
}

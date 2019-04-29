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
        $this->call(UsuariosSeeder::class);
        $this->call(ModalidadeSeeder::class);
        $this->call(ProdutosSeeder::class);
        $this->call(ClientesSeeder::class);
        $this->call(PlanosSeeder::class);
        $this->call(DuracaoPlanoSeeder::class);
        $this->call(ModalidadePlanoSeeder::class);
        $this->call(TurmasSeeder::class);
        $this->call(ItensTurmaSeeder::class);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'Bernardo Issenguel', 'genero' => 'Masculino', 'telefone' => '929616583', 'email' => 'bernardo@gmail.com', 'password' => Hash::make('321')],
            ['name' => 'Manuel Issenguel', 'genero' => 'Masculino', 'telefone' => '994856927', 'email' => 'manuel@gmail.com', 'password' => Hash::make('321')],
            ['name' => 'Guvulo Issenguel', 'genero' => 'Masculino', 'telefone' => '994856928', 'email' => 'guvulo@gmail.com', 'password' => Hash::make('321')],
            ['name' => 'Isenguel Issenguel', 'genero' => 'Masculino', 'telefone' => '994866937', 'email' => 'issenguel@gmail.com', 'password' => Hash::make('321')],
        ]);
    }
}

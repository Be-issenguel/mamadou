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
            ['name' => 'Bernardo Issenguel','email' => 'bernardo@gmail.com','password' => Hash::make('321')],
            ['name' => 'Manuel Issenguel','email' => 'manuel@gmail.com','password' => Hash::make('321')],
            ['name' => 'Guvulo Issenguel','email' => 'guvulo@gmail.com','password' => Hash::make('321')],
            ['name' => 'Isenguel Issenguel','email' => 'issenguel@gmail.com','password' => Hash::make('321')]
        ]);
    }
}

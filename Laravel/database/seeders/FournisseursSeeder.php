<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FournisseursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
         DB::table('fournisseurs')->insert([
             [
                'NEQ' => '1234567890',
                'Courriel' => 'test@test.com',
                'MotDePasse' => Hash::make('password1234')
             ]
         ]);
    }
}

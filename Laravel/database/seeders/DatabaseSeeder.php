<?php

namespace Database\Seeders;

use App\Models\Fournisseur;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(FournisseursSeeder::class);
        $this->call(ServicesSeeder::class);
        $this->call(LicencesRBQsSeeder::class);
        $this->call(CoordonneesSeeder::class);
        $this->call(ContactsFournisseursSeeder::class);
        $this->call(BrochuresSeeder::class);
        $this->call(ModificationsFournisseursSeeder::class);
        $this->call(UtilisateursSeeder::class);
        $this->call(ParametresSystemesSeeder::class);
        $this->call(ModelesCourrielsSeeder::class);
    }
}

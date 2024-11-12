<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('
        CREATE TRIGGER before_insert_licences_rbqs
        BEFORE INSERT ON licences_rbqs
        FOR EACH ROW
        BEGIN
            SET NEW.Travaux_Permis = IFNULL((
                SELECT Code_Sous_Categorie
                FROM categories_rbqs
                WHERE Code_Sous_Categorie REGEXP CONCAT(\'^\', NEW.Code_Sous_Categorie)
                LIMIT 1
            ), \'Aucune Valeur\');
        END;

        
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('
            DROP TRIGGER IF EXISTS before_insert_licences_rbqs;
        ');
    }
};

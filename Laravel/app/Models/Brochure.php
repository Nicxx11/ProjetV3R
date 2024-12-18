<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brochure extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'Nom','NomUnique', 'TypeFichier', 'Taille', 'DateCreation', 'No_Fournisseur', 'Contenu',
    ];
}

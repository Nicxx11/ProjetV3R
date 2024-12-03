<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brochure extends Model
{
    use HasFactory;

    protected $fillable = ['Nom','TypeFichier','Taille','DateCreation','No_Fournisseur'];
}

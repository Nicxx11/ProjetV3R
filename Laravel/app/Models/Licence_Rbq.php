<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence_Rbq extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "licences_rbqs";
    protected $fillable = ['No_Licence_RBQ','Statut','TypeLicence','Categorie','Code_Sous_Categorie','Travaux_Permis','No_Fournisseur'];
}

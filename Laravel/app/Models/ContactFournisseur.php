<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactFournisseur extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "contacts_fournisseurs";
    protected $fillable = ['Prenom','Nom','Fonction','Courriel','TypeTelephone','Numero','Poste','No_Fournisseur'];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordonnee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['NoCivique', 'Rue', 'Bureau','Ville','Province','CodePostal','CodeRegionAdministrative','SiteInternet','TypeTelephone','Numero','Poste','No_Fournisseur'];
}

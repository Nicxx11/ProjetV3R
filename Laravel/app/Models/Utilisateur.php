<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    public $timestamps = false;
    protected $fillable = ['Prenom','Nom','Courriel','Role','MotDePasse'];
}

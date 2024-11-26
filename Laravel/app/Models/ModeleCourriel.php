<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeleCourriel extends Model
{
    use HasFactory;
    protected $timestamps = false;
    protected $table = 'modeles_courriels';

    protected $fillable = ['NomModele', 'ObjetModele', 'MessageModele'];
}

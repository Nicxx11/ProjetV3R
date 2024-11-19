<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parametres_systeme extends Model
{
    use HasFactory;

    protected $table = "parametres_systemes";

    protected $fillable = ['Approvisionnement', 'DelaiRevision', 'TailleMaxBrochures', 'Finances'];
}

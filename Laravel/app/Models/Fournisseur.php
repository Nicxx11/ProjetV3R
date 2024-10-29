<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    public function contactFournisseurs()
    {
        return $this->hasMany(ContactFournisseur::class);
    }

    public $timestamps = false;
    protected $fillable = ['id', 'NEQ', 'Courriel', 'Entreprise', 'MotDePasse', 'Details', 'No_TPS', 'No_TVQ', 'Conditions_Paiement', 'Devise', 'Mode_Communication', 'Etat_Demande'];
}

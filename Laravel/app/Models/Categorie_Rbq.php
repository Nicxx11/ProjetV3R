<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie_Rbq extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = "categories_rbqs";

    public function getCategoriesByType($type = 'Général')
    {
        return self::where('Categorie', $type)->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\ModeleCourriel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\parametres_systeme;
use Log;

class ParametresSystemeController extends Controller
{
    public function index(){
        $modeles = ModeleCourriel::all();

        return view('admin.modeles', compact('modeles'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'message_modele' => 'required|string',
        ]);

        $modele = ModeleCourriel::findOrFail($request->input('modele_id'));
        $modele->MessageModele = $request->input('message_modele');
        $modele->save();

        return redirect()->back()->with('success', 'Modèle mis à jour avec succès!');
    }

    public function getModele($id){
        $modele = ModeleCourriel::find($id);
            
        if ($modele) {
            return response()->json([
                'message' => $modele->MessageModele
            ]);
        }
        
        return response()->json([
            'message' => ''
        ], 404);
    }
}

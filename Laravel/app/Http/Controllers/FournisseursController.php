<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\Categorie_Rbq;
use Illuminate\Support\Facades\Route;

class FournisseursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        $categories_rbq = new Categorie_Rbq();
        $rbqs_general = $categories_rbq->getCategoriesByType('Général');
        $rbqs_specialise = $categories_rbq->getCategoriesByType('Spécialisé');


        if(Route::currentRouteName() == "fournisseurs.list"){
            return view('employe.listeFournisseur', compact('fournisseurs', 'rbqs_general', 'rbqs_specialise'));
        }
        
        return View('login.connexion', compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('login.inscription');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NEQ' => 'nullable|digits:10',
            'Courriel' => 'required|email|unique:fournisseurs',
            'Entreprise' => 'required|string|max:64',
            'MotDePasse' => 'required|string|min:8|max:12|confirmed',
            'Details' => 'nullable|string|max:500'
        ], [
            'NEQ.required' => 'Le NEQ est obligatoire',
            'NEQ.digits' => 'Le NEQ doit contenir 10 chiffres',
            'Courriel.required' => 'Le courriel est obligatoire',
            'Courriel.email' => 'Le courriel doit être valide',
            'Entreprise.required' => 'Le nom de l\'entreprise est obligatoire',
            'MotDePasse.required' => 'Le mot de passe est obligatoire',
            'MotDePasse.min' => 'Le mot de passe doit contenir un minimum de 8 caractères',
            'MotDePasse.max' => 'Le mot de passe ne doit pas dépasser 12 caractères',
            'MotDePasse.confirmed' => 'Les mots de passe doivent correspondre',
            'Details.max' => 'Maximum de 500 caractères',
        ]);

        // Hash du mot de passe avant d'enregistrer
        $validatedData['MotDePasse'] = bcrypt($validatedData['MotDePasse']);

        // Enregistrement dans la base de données
        Fournisseur::create($validatedData);

        return redirect()->route('index.index')->with('success', 'Inscription réussie!');
    }

    public function login()
    {
        return redirect()->route('fournisseurs.list')->with('success','Connexion réussi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

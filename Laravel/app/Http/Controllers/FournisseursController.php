<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;

class FournisseursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();

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
            'MotDePasse' => 'required|string|min:8|max:12',
            'Details' => 'nullable|string|max:500'
        ]);

        // Hash du mot de passe avant d'enregistrer
        $validatedData['MotDePasse'] = bcrypt($validatedData['MotDePasse']);

        // Enregistrement dans la base de données
        Fournisseur::create($validatedData);

        return redirect()->route('login.inscription')->with('success', 'Inscription réussie!');
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

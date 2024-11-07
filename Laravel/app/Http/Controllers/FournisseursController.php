<?php

namespace App\Http\Controllers;

use App\Models\Licence_Rbq;
use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\Categorie_Rbq;
use App\Models\Coordonnee;
use App\Models\Service;
use App\Models\ContactFournisseur;
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
        $coordonnees = Coordonnee::all();
        $rbqs_general = $categories_rbq->getCategoriesByType('Général');
        $rbqs_specialise = $categories_rbq->getCategoriesByType('Spécialisé');
        $services = Service::all();
        $licences_rbqs = Licence_Rbq::all();


        if(Route::currentRouteName() == "fournisseurs.list"){
            return view('employe.listeFournisseur', compact('fournisseurs', 'coordonnees', 'services', 'rbqs_general', 'rbqs_specialise', 'licences_rbqs'));
        }
        if(Route::currentRouteName() == "fournisseurs.profile"){
            return view('fournisseur.profile', compact('fournisseurs', 'rbqs_general', 'rbqs_specialise'));
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
        $validatedData['MotDePasse'] = hash('sha1', $validatedData['MotDePasse']);

        // Enregistrement dans la base de données
        Fournisseur::create($validatedData);

        return redirect()->route('index.index')->with('success', 'Inscription réussie!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'MotDePasse' => 'required|string',
        ]);

        $inputNeq = $request->input('id');

        $fournisseur = Fournisseur::where('NEQ',$inputNeq)->first();

        $contactFourni = ContactFournisseur::where('No_Fournisseur',$fournisseur->id)->get();

        $service = Service::where('No_Fournisseur',$fournisseur->id)->get();

        $licRbq = Licence_Rbq::where('No_Fournisseur',$fournisseur->id)->get();
    
        $coord = Coordonnee::where('No_Fournisseur',$fournisseur->id)->first();

        session([
            'id' => $inputNeq,
            'fournisseur' => $fournisseur,
            'contactFourni' => $contactFourni,
            'service' => $service,
            'licRbq' => $licRbq,
            'coord' => $coord
        ]);


        if (!$fournisseur || hash('sha1', $request->input('MotDePasse')) != $fournisseur->MotDePasse) {
            // Ajouter un message d'erreur personnalisé pour le champ 'id'
            return redirect()->back()->withErrors(['loginError' => 'ID ou mot de passe incorrect']);
        }

        if($fournisseur)
        {
            if(hash('sha1',$request->input('MotDePasse'), $fournisseur->MotDePasse))
            {
                return view('fournisseur.profile',compact('fournisseur','contactFourni','service','licRbq','coord'))->with('success','Connexion réussi');
            }
            else{
                return redirect()->route('index.index')->with('error','identifiant non valide');
            }
        }
        else{
            return redirect()->route('index.index')->with('error','identifiant non valide');
        }


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
    public function edit()
    {        
        $id = session('id');
        $fournisseur = session('fournisseur');
        $contactFourni = session('contactFourni');
        $service = session('service');
        $licRbq = session('licRbq');
        $coord = session('coord');


        return view('fournisseur.editProfile', compact('id', 'fournisseur','contactFourni','service','licRbq','coord'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Récupérer l'ID du fournisseur à partir de la session
        $id = session('id');
        
        // Récupérer le fournisseur et autres données de la session
        $fournisseur = session('fournisseur');
        $contactFourni = session('contactFourni');
        $service = session('service');
        $licRbq = session('licRbq');
        $coord = session('coord');
    
        // Validation des données reçues via le formulaire
        $request->validate([
            'entreprise' => 'required|string|max:255',
            'noCivic' => 'required|numeric',
            'rue' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'codePostal' => 'required|string|max:10',
            'courriel' => 'required|email|max:255',
            'coordNum' => 'required|numeric',
            'numPoste' => 'nullable|numeric',
            'contactPrenom' => 'nullable|array',
            'contactNom' => 'nullable|array',
            'contactFonction' => 'nullable|array',
            'contactCourriel' => 'nullable|array|email',
            'contactNumero' => 'nullable|array|numeric',
            'contactPoste' => 'nullable|array|numeric',
        ]);
    
        // Mise à jour du fournisseur
        //$fournisseur = Fournisseur::findOrFail($id);
        //$fournisseur->Entreprise = $request->input('entreprise');
        //$fournisseur->Courriel = $request->input('courriel');
        //$fournisseur->save();
        $fournisseur->update([
            'Entreprise' => $request->input('entreprise'),
            'Courriel' => $request->input('courriel'),
        ]);
    
        // Mise à jour des coordonnées
        $coord = Coordonnee::where('fournisseur_id', $id)->first();
        $coord->NoCivique = $request->input('noCivic');
        $coord->Rue = $request->input('rue');
        $coord->Ville = $request->input('ville');
        $coord->Province = $request->input('province');
        $coord->CodePostal = $request->input('codePostal');
        $coord->Numero = $request->input('coordNum');
        $coord->Poste = $request->input('numPoste', null); // Si non défini, valeur par défaut null
        $coord->save();
    
        // Mise à jour des contacts
        if ($request->has('contactPrenom')) {
            foreach ($request->input('contactPrenom') as $index => $prenom) {
                $contact = ContactFournisseur::findOrFail($index);  // Trouve chaque contact par son ID
                $contact->Prenom = $prenom;
                $contact->Nom = $request->input('contactNom')[$index];
                $contact->Fonction = $request->input('contactFonction')[$index];
                $contact->Courriel = $request->input('contactCourriel')[$index];
                $contact->Numero = $request->input('contactNumero')[$index];
                $contact->Poste = $request->input('contactPoste')[$index];
                $contact->save();
            }
        }
    
        // Rediriger vers la page du fournisseur avec un message de succès
        return redirect()->route('fournisseur.profile', ['id' => $id])
                         ->with('success', 'Le profil du fournisseur a été mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

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
use Illuminate\Support\Facades\Http;
use Log;
use Symfony\Component\ErrorHandler\Debug;

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
        $categories_rbq = new Categorie_Rbq();
        $rbqs_general = $categories_rbq->getCategoriesByType('Général');
        $rbqs_specialise = $categories_rbq->getCategoriesByType('Spécialisé');

        return View('login.inscription', compact('rbqs_general', 'rbqs_specialise'));
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
            'id' => $fournisseur->id,
            'neq' => $inputNeq,
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
                return view('fournisseur.profile',compact('inputNeq','fournisseur','contactFourni','service','licRbq','coord'))->with('success','Connexion réussi');
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
        $neq = session('neq');
        $fournisseur = session('fournisseur');
        $contactFourni = session('contactFourni');
        $service = session('service');
        $licRbq = session('licRbq');
        $coord = session('coord');


        return view('fournisseur.editProfile', compact('id','neq', 'fournisseur','contactFourni','service','licRbq','coord'));
    }/*'inputNeq','fournisseur','contactFourni','service','licRbq','coord'*/

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $fournisseur = Fournisseur::where('NEQ',session('neq'))->first();

        $contactFourni = ContactFournisseur::where('No_Fournisseur',$fournisseur->id)->get();

        $service = Service::where('No_Fournisseur',$fournisseur->id)->get();

        $licRbq = Licence_Rbq::where('No_Fournisseur',$fournisseur->id)->get();
    
        $coord = Coordonnee::where('No_Fournisseur',$fournisseur->id)->first();

        $currentId = session('id');

        $newName = $request->input('entreprise');

        $fournisseurs = Fournisseur::find($currentId);
        $fournisseurs->Entreprise = $newName;

        $fournisseurs->save();

        return view('fournisseur.profile',compact('fournisseur','contactFourni','service','licRbq','coord'))->with('success','Connexion réussi');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function checkRBQ(Request $request)
    {
        // Get the RBQ number from the incoming request
        $rbq = $request->input('rbq');


        $url = 'https://www.donneesquebec.ca/recherche/api/3/action/datastore_search_sql';
        $query = [
            'sql' => 'SELECT * from "32f6ec46-85fd-45e9-945b-965d9235840a" WHERE "Numero de licence" LIKE "' . $rbq . '" LIMIT 1'
        ];

        $fullUrl = $url . '?sql=SELECT%20*%20from%20"32f6ec46-85fd-45e9-945b-965d9235840a"%20WHERE%20"Numero%20de%20licence"%20LIKE%20%27'.$rbq.'%27%20LIMIT%201'; // Builds the full URL with query parameters
        Log::info('Full URL:', ['url' => $fullUrl]);

        $response = Http::withoutVerifying()->get($fullUrl);

        // $response = Http::withoutVerifying()->get('https://www.donneesquebec.ca/recherche/api/3/action/datastore_search_sql', [
        //     'sql' => 'SELECT * from "32f6ec46-85fd-45e9-945b-965d9235840a" WHERE "Numero de licence" LIKE "'. $rbq . '" LIMIT 1'
        // ]);

        if ($response->successful()) {
            $data = $response->json(); // Get the response body as an array
            
            if (empty($data['result']['records'])) {
                return response()->json(['message' => 'No records found.']);
            } else {
                return response()->json($data['result']['records']);
            }
        } else {
            return response()->json(['message' => 'Request failed with status: ' . $response->status()], 400);
        }
    }
}

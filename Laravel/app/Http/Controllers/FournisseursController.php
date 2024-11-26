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


        if (Route::currentRouteName() == "fournisseurs.list") {
            return view('employe.listeFournisseur', compact('fournisseurs', 'coordonnees', 'services', 'rbqs_general', 'rbqs_specialise', 'licences_rbqs'));
        }
        if (Route::currentRouteName() == "fournisseurs.profile") {
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

        Log::info('REQUEST VALUE:');
        Log::info($request); 

        $request['No_Licence_RBQ'] = str_replace('-','',$request['No_Licence_RBQ']);
        $request['Etat_Demande'] = 'En attente';
        $request['Numero'] = str_replace(' ','',str_replace('-', '', $request['Numero']));
        Log::info('VILLE TEXT');
        Log::info($request['villeText']);

        if($request['villeText'] !== null){
            $request['Ville'] = $request['villeText'];
        }
//MotDePasse1$

        $validatedFournisseur = $request->validate([
            'NEQ' => 'nullable|digits:10',
            'Courriel' => 'required|email|unique:fournisseurs',
            'Entreprise' => 'required|string|max:64',
            'MotDePasse' => [
                'required',
                'string',
                'min:8', 
                'max:12', 
                'confirmed', 
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,12}$/' //au moins 1 maj, 1 min, 1 chiffre, 1 symbole
            ],
            'Etat_Demande' => 'required|string',
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
            'MotDePasse.regex' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un symbole.',
            'Details.max' => 'Maximum de 500 caractères',
        ]);

        $validatedRBQ = $request->validate([
            'No_Licence_RBQ' => 'nullable|string|max:10',
            'Statut' => 'nullable|string|max:23',
            'TypeLicence' => 'nullable|string|max:26',
            'Categorie' => 'nullable|string|max:10',
            'Code_Sous_Categorie' => 'nullable|string|max:64',
            'Travaux_Permis' => 'nullable|string|max:64',
        ]);

        $validatedCoordonnees = $request->validate([
            'NoCivique' => 'required|string|max:8',
            'Rue' => 'required|string|max:64',
            'Bureau' => 'nullable|string|max:8',
            'Ville' => 'required|string|max:64',
            'CodePostal' => 'required|string|max:6',
            'Province' => 'required|string|max:255',
            'TypeTelephone' => 'required|string|max:255',
            'Numero' => 'required|string|max:10',
            'Poste' => 'nullable|string|max:6',
        ], [
            'NoCivique.required' => 'Le numéro civique est obligatoire',
            'NoCivique.max' => 'Le numéro civique ne doit pas dépasser 8 caractères',
            'Rue.required' => 'La rue est obligatoire',
            'Rue.max' => 'La rue ne doit pas dépasser 64 caractères',
            'Bureau.max' => 'Le bureau ne doit pas dépasser 8 caractères',
            'Ville.required' => 'La ville est obligatoire',
            'Ville.max' => 'La ville ne doit pas dépasser 64 caractères',
            'Province.required' => 'La province est obligatoire',
            'Province.max' => 'La province ne doit pas dépasser 255 caractères',
            'CodePostal.required' => 'Le code postal est obligatoire',
            'CodePostal.max' => 'Le code postal ne doit pas dépasser les 6 caractères',
            'TypeTelephone.required' => 'Le type de téléphone est obligatoire',
            'TypeTelephone.max' => 'Le type de téléphone ne doit pas dépasser 255 caractères',
            'Numero.required' => 'Le numéro de téléphone est obligatoire',
            'Numero.max' => 'Le numéro de téléphone ne doit pas dépasser 10 caractères',
            'Poste.max' => 'Le poste ne doit pas dépasser 6 caractères'
        ]);

        // Hash du mot de passe avant d'enregistrer
        $validatedFournisseur['MotDePasse'] = hash('sha1', $validatedFournisseur['MotDePasse']);

        // Enregistrement dans la base de données
        $fournisseur = Fournisseur::create($validatedFournisseur);

        $validatedRBQ['No_Fournisseur'] = $fournisseur->id;
        $validatedCoordonnees['No_Fournisseur'] = $fournisseur->id;
        $validatedCoordonnees['RegionAdministrative'] = $this->getRegionByVille($validatedCoordonnees['Ville']);
        $validatedCoordonnees['CodeRegionAdministrative'] = $this->getCodeRegion($validatedCoordonnees['RegionAdministrative']);

        $correctRBQ = true;
        foreach ($validatedRBQ as $key => $value) {
            if($value == null || $value === ''){
                $correctRBQ = false;
            }
        }

        if($correctRBQ){
            Licence_Rbq::create($validatedRBQ);
        }


        Log::info('COORDONNEES');
        Log::info($validatedCoordonnees);
        
        Coordonnee::create($validatedCoordonnees);
        
        $controlleur = new MailController();
        $controlleur->sendWelcomeEmail($validatedFournisseur["Courriel"]);


        return redirect()->route('index.index')->with('success', 'Inscription réussie!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'MotDePasse' => 'required|string',
        ]);

        $input = $request->input('id');
        if(filter_var($input, FILTER_VALIDATE_EMAIL)){
            $fournisseur = Fournisseur::where('Courriel',$input)->first();
        } else {
            $fournisseur = Fournisseur::where('NEQ',$input)->first();
        }

        $inputNEQ = $fournisseur->NEQ;
        $contactFourni = ContactFournisseur::where('No_Fournisseur',$fournisseur->id)->get();

        $contactFourni = ContactFournisseur::where('No_Fournisseur', $fournisseur->id)->get();

        $service = Service::where('No_Fournisseur', $fournisseur->id)->get();

        $licRbq = Licence_Rbq::where('No_Fournisseur', $fournisseur->id)->get();

        $coord = Coordonnee::where('No_Fournisseur', $fournisseur->id)->first();

        session([
            'id' => $fournisseur->id,
            'neq' => $inputNEQ,
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
                return view('fournisseur.profile',compact('inputNEQ','fournisseur','contactFourni','service','licRbq','coord'))->with('success','Connexion réussi');
            }
        } else {
            return redirect()->route('index.index')->with('error', 'identifiant non valide');
        }


    }


    public function updatePassword($id, $password){
     
        $fournisseur = Fournisseur::find($id);

        if(!$fournisseur){
            return redirect()->route('index.index')->with('message', 'Erreur lors de la mise à jour du mot de passe. Assurez-vous que le fournisseur est existant.');
        }

        $hashedPassword = hash('sha1', $password);

        $fournisseur->MotDePasse = $hashedPassword;
        $fournisseur->save();
       
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


        return view('fournisseur.editProfile', compact('id', 'neq', 'fournisseur', 'contactFourni', 'service', 'licRbq', 'coord'));
    }/*'inputNeq','fournisseur','contactFourni','service','licRbq','coord'*/

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $fournisseur = Fournisseur::where('NEQ', session('neq'))->first();
        $contactFourni = ContactFournisseur::where('No_Fournisseur', $fournisseur->id)->get();
        $service = Service::where('No_Fournisseur', $fournisseur->id)->get();
        $licRbq = Licence_Rbq::where('No_Fournisseur', $fournisseur->id)->get();
        $coord = Coordonnee::where('No_Fournisseur', $fournisseur->id)->first();

        $currentId = session('id');

        //---fournisseurs---//
        $newName = $request->input('entreprise');
        $newCourriel = $request->input('courriel');

        //---Coordonnees----//
        $newNoCivic = $request->input('noCivic');
        $newRue = $request->input('rue');
        $newVille = $request->input('ville');
        $newProvince = $request->input('province');
        $newCodePostal = $request->input('codePostal');
        $newNumTel = $request->input('coordNum');
        $newPoste = $request->input('numPoste');

        //---Modification profil Fournisseurs---//
        $fournisseurs = Fournisseur::find($currentId);
        $fournisseurs->Entreprise = $newName;
        $fournisseurs->Courriel = $newCourriel;

        //---Modification profil Coordonnees---//
        $coordonnees = Coordonnee::find($currentId);
        $coordonnees->NoCivique = $newNoCivic;
        $coordonnees->Rue = $newRue;
        $coordonnees->Ville = $newVille;
        $coordonnees->Province = $newProvince;
        $coordonnees->CodePostal = $newCodePostal;
        $coordonnees->Numero = $newNumTel;
        $coordonnees->Poste = $newPoste;

        //---Modification profil Contact---//

        // Récupérer les données envoyées
        $contactIds = $request->input('contactId'); // Tableau avec les ids des contacts
        $contactPrenoms = $request->input('contactPrenom'); // Tableau des prénoms
        $contactNoms = $request->input('contactNom'); // Tableau des noms
        $contactFonctions = $request->input('contactFonction'); // Tableau des fonctions
        $contactCourriels = $request->input('contactCourriel'); // Tableau des courriels
        $contactNumeros = $request->input('contactNumero'); // Tableau des numéros
        $contactPostes = $request->input('contactPoste'); // Tableau des postes (si présents)

        // Pour chaque contact, on met à jour les informations
        if($contactIds != null){
            foreach ($contactIds as $contactId) {
                $contact = ContactFournisseur::find($contactId); // Trouver le contact par son id

                if ($contact) {
                    // Mettre à jour les informations du contact
                    $contact->Prenom = $contactPrenoms[$contactId];
                    $contact->Nom = $contactNoms[$contactId];
                    $contact->Fonction = $contactFonctions[$contactId];
                    $contact->Courriel = $contactCourriels[$contactId];
                    $contact->Numero = $contactNumeros[$contactId];

                    if (isset($contactPostes[$contactId])) {
                        $contact->Poste = $contactPostes[$contactId];
                    }

                    // Sauvegarder les changements
                    $contact->save();
                }
            }
        }
        $fournisseurs->save();
        $coordonnees->save();

        $fournisseur = Fournisseur::where('NEQ', session('neq'))->first();
        $coord = Coordonnee::where('No_Fournisseur', session('id'))->first();
        $contactFourni = ContactFournisseur::where('No_Fournisseur', session('id'))->get();

        session([
            'fournisseur' => $fournisseur,
            'contactFourni' => $contactFourni,
            'service' => $service,
            'licRbq' => $licRbq,
            'coord' => $coord
        ]);

        return view('fournisseur.profile', compact('fournisseur', 'contactFourni', 'service', 'licRbq', 'coord'))->with('success', 'Connexion réussi');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyContact(int $contactId)
    {
        $contact = ContactFournisseur::find($contactId);
        $fournisseur = Fournisseur::where('NEQ', session('neq'))->first();
        $contactFourni = ContactFournisseur::where('No_Fournisseur', $fournisseur->id)->get();
        $service = Service::where('No_Fournisseur', $fournisseur->id)->get();
        $licRbq = Licence_Rbq::where('No_Fournisseur', $fournisseur->id)->get();
        $coord = Coordonnee::where('No_Fournisseur', $fournisseur->id)->first();
    
    if ($contact) {
        $contact->delete();

        $fournisseur = Fournisseur::where('NEQ', session('neq'))->first();
        $contactFourni = ContactFournisseur::where('No_Fournisseur', $fournisseur->id)->get();
        $service = Service::where('No_Fournisseur', $fournisseur->id)->get();
        $licRbq = Licence_Rbq::where('No_Fournisseur', $fournisseur->id)->get();
        $coord = Coordonnee::where('No_Fournisseur', $fournisseur->id)->first();

        session([
            'fournisseur' => $fournisseur,
            'contactFourni' => $contactFourni,
            'service' => $service,
            'licRbq' => $licRbq,
            'coord' => $coord
        ]);

        return view('fournisseur.profile', compact('fournisseur', 'contactFourni', 'service', 'licRbq', 'coord'))->with('success', 'Connexion réussi');
    }

    return view('fournisseur.profile', compact('fournisseur', 'contactFourni', 'service', 'licRbq', 'coord'))->with('error', 'Contact non trouvé!');
    }

    public function ajoutContact(Request $request)
    {
        $fournisseur = Fournisseur::where('NEQ', session('neq'))->first();

        if ($fournisseur) {
            // Créer un nouveau contact pour le fournisseur
            $contact = new ContactFournisseur();
            
            // Remplir les champs du contact avec les données de la requête (ou d'autres sources)
            $contact->Prenom = $request->input('Prenom');
            $contact->Nom = $request->input('Nom');
            $contact->Fonction = $request->input('Fonction');
            $contact->Courriel = $request->input('Courriel');
            $contact->Numero = $request->input('Numero');
            $contact->TypeTelephone = $request->input('type');
            $contact->Poste = $request->input('Poste', '');  // Poste est facultatif
            $contact->No_Fournisseur = $fournisseur['id'];
            // Sauvegarder le contact dans la base de données
            $contact->save();
    
            // Récupérer les informations actualisées pour le fournisseur
            $contactFourni = ContactFournisseur::where('No_Fournisseur', $fournisseur->id)->get();
            $service = Service::where('No_Fournisseur', $fournisseur->id)->get();
            $licRbq = Licence_Rbq::where('No_Fournisseur', $fournisseur->id)->get();
            $coord = Coordonnee::where('No_Fournisseur', $fournisseur->id)->first();
    
            // Mettre à jour les données de session
            session([
                'fournisseur' => $fournisseur,
                'contactFourni' => $contactFourni,
                'service' => $service,
                'licRbq' => $licRbq,
                'coord' => $coord
            ]);

        return view('fournisseur.profile', compact('fournisseur', 'contactFourni', 'service', 'licRbq', 'coord'))->with('success', 'Connexion réussi');
    }

    return view('fournisseur.profile', compact('fournisseur', 'contactFourni', 'service', 'licRbq', 'coord'))->with('error', 'Contact non trouvé!');
    }

    public function checkRBQ(Request $request)
    {
        // Get the RBQ number from the incoming request
        $rbq = $request->input('rbq');

        $url = 'https://www.donneesquebec.ca/recherche/api/3/action/datastore_search_sql';
        // $query = [
        //     'sql' => 'SELECT * from "32f6ec46-85fd-45e9-945b-965d9235840a" WHERE "Numero de licence" LIKE "' . $rbq . '" LIMIT 1'
        // ];

        $fullUrl = $url . '?sql=SELECT%20*%20from%20"32f6ec46-85fd-45e9-945b-965d9235840a"%20WHERE%20"Numero%20de%20licence"%20LIKE%20%27' . $rbq . '%27%20LIMIT%201'; // Builds the full URL with query parameters
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

    public function getRegionByVille($ville){
        
        $path = public_path('/json/villes.json');
        if (!file_exists($path)){
            return 'error1';
        }

        $villes_json = file_get_contents($path);
        $data = json_decode($villes_json, true);

        if($data === null){
            return 'error2';
        }

        $region = null;
        foreach($data as $entry) {
            if($entry['ville'] === $ville){
                $region = $entry['region'];
                break;
            }
        }

        if ($region !== null) {
            return $region;
        } else {
            return 'error3';
        }
    }

    public function getCodeRegion($region){
        $path = public_path('/json/regions.json');
        if (!file_exists($path)){
            return 'error1';
        }

        $regions_json = file_get_contents($path);
        $data = json_decode($regions_json, true);

        if($data === null){
            return 'error2';
        }

        $codeRegion = null;
        foreach ($data as $entry) {
            if (strpos($entry['regadm'], $region) !== false) {
                preg_match('/\((\d+)\)/', $entry['regadm'], $matches);

                if (isset($matches[1])) {
                    $codeRegion = $matches[1];
                }
                break;
            }
        }
        

        if ($region !== null) {
            return $codeRegion;
        } else {
            return 'error3';
        }
    }

}

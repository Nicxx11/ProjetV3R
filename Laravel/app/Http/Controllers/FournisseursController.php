<?php

namespace App\Http\Controllers;

use App\Models\modification_fournisseur;
use App\Models\parametres_systeme;
use Exception;
use Illuminate\Support\Facades\Storage;
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

class FournisseursController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        $categories_rbq = new Categorie_Rbq();
        $coordonnees = Coordonnee::all();
        $rbqs_general = $categories_rbq->getCategoriesByType('Général');
        $rbqs_specialise = $categories_rbq->getCategoriesByType('Spécialisé');
        $services = Service::all();
        $licences_rbqs = Licence_Rbq::all();
        $brochure = $this->getbrochureBySessionId();

        if (Route::currentRouteName() == "fournisseurs.list") {
            return view('employe.listeFournisseur', compact('fournisseurs', 'coordonnees', 'services', 'rbqs_general', 'rbqs_specialise', 'licences_rbqs'));
        }


        if(Route::currentRouteName() == "fournisseurs.listcommis"){

            $fournisseurs = Fournisseur::where('Etat_Demande', 'Acceptée')->get();
            $no_fournisseurs_acceptes = $fournisseurs->pluck('id');
            $coordonnees = Coordonnee::whereIn('No_Fournisseur', $no_fournisseurs_acceptes)->get();
            $services = Service::whereIn('No_Fournisseur', $no_fournisseurs_acceptes)->get();
            $licences_rbqs = Licence_Rbq::whereIn('No_Fournisseur', $no_fournisseurs_acceptes)->get();

            return view('employe.listeFournisseur', compact('fournisseurs', 'coordonnees', 'services', 'rbqs_general', 'rbqs_specialise', 'licences_rbqs'));
        }

        if (Route::currentRouteName() == "fournisseurs.profile") {
            return view('fournisseur.profile', compact('brochure','fournisseurs', 'rbqs_general', 'rbqs_specialise'));
        }

        return View('login.connexion');
    }

    public function showFournisseurProfile($id){

        // get all ids
        $ids = Fournisseur::pluck('id');

        $matchingId = $ids->first(function ($id2) use ($id) {
            return hash('sha1', $id2) === $id;  // Compare SHA1 hash of the ID
        });

        Log::info('HELP');
        try {
            $fournisseur = Fournisseur::where('id', $matchingId)->first();
            Log::info($fournisseur);
        } catch (Exception $e) {
            Log::error('Error fetching fournisseur: ' . $e->getMessage());
        }
    
        try {
            $coord = Coordonnee::where('No_Fournisseur', $matchingId)->first();
            Log::info($coord);
        } catch (Exception $e) {
            Log::error('Error fetching coord: ' . $e->getMessage());
        }
    
        try {
            $service = Service::whereIn('No_Fournisseur', [$matchingId])->get();
            Log::info($service);
        } catch (Exception $e) {
            Log::error('Error fetching services: ' . $e->getMessage());
        }
    
        try {
            $licRbq = Licence_Rbq::whereIn('No_Fournisseur', [$matchingId])->get();
            Log::info($licRbq);
        } catch (Exception $e) {
            Log::error('Error fetching licRbq: ' . $e->getMessage());
        }
    
        try {
            $contactFourni = ContactFournisseur::whereIn('No_Fournisseur', [$matchingId])->get();
            Log::info('CONTACTFOURNI' . json_encode($contactFourni));
        } catch (Exception $e) {
            Log::error('Error fetching contactFourni: ' . $e->getMessage());
        }
    
        try {
            $brochure = $this->getbrochureId($matchingId);
            Log::info("Filtered Files: " . json_encode($brochure));
        } catch (Exception $e) {
            Log::error('Error fetching filtered files: ' . $e->getMessage());
        }
    
        try {
            $inputNEQ = $fournisseur->NEQ;
            Log::info('Input NEQ: ' . $inputNEQ);
        } catch (Exception $e) {
            Log::error('Error accessing NEQ: ' . $e->getMessage());
        } 
        

        return View('fournisseur.profileUser', compact('inputNEQ', 'brochure', 'fournisseur', 'coord', 'service', 'licRbq', 'contactFourni'));
    }

    public function create()
    {
        $categories_rbq = new Categorie_Rbq();
        $rbqs_general = $categories_rbq->getCategoriesByType('Général');
        $rbqs_specialise = $categories_rbq->getCategoriesByType('Spécialisé');

        $mail = new MailController();
        $mail->sendFournisseurEmail(parametres_systeme::all()->first()->Approvisionnement,'Ajout fournisseur');

        return View('login.inscription', compact('rbqs_general', 'rbqs_specialise'));
    }

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
        $controlleur->sendFournisseurEmail($validatedFournisseur["Courriel"], 'Accusé de réception');


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

        if (!$fournisseur){
            return redirect()->route('index.index')->withErrors(['loginError' => 'identifiant ou mot de passe incorrect']);
        }

        $contactFourni = ContactFournisseur::where('No_Fournisseur',$fournisseur->id)->get();

        $contactFourni = ContactFournisseur::where('No_Fournisseur', $fournisseur->id)->get();

        $service = Service::where('No_Fournisseur', $fournisseur->id)->get();

        $licRbq = Licence_Rbq::where('No_Fournisseur', $fournisseur->id)->get();

        $coord = Coordonnee::where('No_Fournisseur', $fournisseur->id)->first();

        $brochure = $this->getbrochureBySessionId();


        if (!$fournisseur || hash('sha1', $request->input('MotDePasse')) != $fournisseur->MotDePasse) {
            // Ajouter un message d'erreur personnalisé pour le champ 'id'
            return redirect()->back()->withErrors(['loginError' => 'identifiant ou mot de passe incorrect']);
        }
        
        if($fournisseur->NEQ){
            $inputNEQ = $fournisseur->NEQ;

            session([
                'id' => $fournisseur->id,
                'neq' => $inputNEQ,
                'fournisseur' => $fournisseur,
                'contactFourni' => $contactFourni,
                'service' => $service,
                'licRbq' => $licRbq,
                'coord' => $coord
            ]);
            
            if($fournisseur)
            {    
                if(hash('sha1',$request->input('MotDePasse'), $fournisseur->MotDePasse))
                {
                    return view('fournisseur.profile',compact('inputNEQ','fournisseur','contactFourni','service','licRbq','coord','brochure'))->with('success','Connexion réussi');
                }
            } else {
                return redirect()->route('index.index')->with('error', 'identifiant non valide');
            }
    
        } else {
            session([
                'id' => $fournisseur->id,
                'fournisseur' => $fournisseur,
                'contactFourni' => $contactFourni,
                'service' => $service,
                'licRbq' => $licRbq,
                'coord' => $coord
            ]);

            if($fournisseur)
            {    
                if(hash('sha1',$request->input('MotDePasse'), $fournisseur->MotDePasse))
                {
                    return view('fournisseur.profile',compact('fournisseur','contactFourni','service','licRbq','coord','brochure'))->with('success','Connexion réussi');
                }
            } else {
                return redirect()->route('index.index')->with('error', 'identifiant non valide');
            }
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
    }

    public function update(Request $request)
    {

        $fournisseur = Fournisseur::where('id', session('id'))->first();
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

        $fournisseur = Fournisseur::where('id', session('id'))->first();
        if($fournisseur->Etat_Demande != $request->input('Etat_Demande')){
            if($fournisseur->Etat_Demande == "Acceptée"){
                //$controlleur = new MailController();
                //$controlleur->sendFournisseurEmail($request->input('courriel'), 'Confirmation acceptation');
            }

            if($fournisseur->Etat_Demande == "Refusée"){
                //$controlleur = new MailController();
                //$controlleur->sendFournisseurEmail($request->input('courriel'), 'Refus demande');

                //TODO ajouter le delete des brochures
            }
        }

        $fournisseurs->save();
        $coordonnees->save();

        $fournisseur = Fournisseur::where('id', session('id'))->first();
        $coord = Coordonnee::where('No_Fournisseur', session('id'))->first();
        $contactFourni = ContactFournisseur::where('No_Fournisseur', session('id'))->get();

        session([
            'id' => $fournisseur->id,
            'fournisseur' => $fournisseur,
            'contactFourni' => $contactFourni,
            'service' => $service,
            'licRbq' => $licRbq,
            'coord' => $coord
        ]);

        $brochure = $this->getbrochureBySessionId();

        return view('fournisseur.profile', compact('fournisseur', 'contactFourni', 'service', 'licRbq', 'coord','brochure'))->with('success', 'Connexion réussi');

    }

    public function destroyContact(int $contactId)
    {
        $contact = ContactFournisseur::find($contactId);
        $fournisseur = Fournisseur::where('NEQ', session('neq'))->first();
        $contactFourni = ContactFournisseur::where('No_Fournisseur', $fournisseur->id)->get();
        $service = Service::where('No_Fournisseur', $fournisseur->id)->get();
        $licRbq = Licence_Rbq::where('No_Fournisseur', $fournisseur->id)->get();
        $coord = Coordonnee::where('No_Fournisseur', $fournisseur->id)->first();
        $brochure = $this->getbrochureBySessionId();

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

        return view('fournisseur.profile', compact('fournisseur', 'contactFourni', 'service', 'licRbq', 'coord','brochure'))->with('success', 'Connexion réussi');
    }

    return view('fournisseur.profile', compact('fournisseur', 'contactFourni', 'service', 'licRbq', 'coord','brochure'))->with('error', 'Contact non trouvé!');
    }
    public function ajoutContact(Request $request)
    {
        $fournisseur = Fournisseur::where('NEQ', session('neq'))->first();
        $brochure = $this->getbrochureBySessionId();

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
            

        return view('fournisseur.profile', compact('fournisseur', 'contactFourni', 'service', 'licRbq', 'coord','brochure'))->with('success', 'Connexion réussi');
    }

    return view('fournisseur.profile', compact('fournisseur', 'contactFourni', 'service', 'licRbq', 'coord','brochure'))->with('error', 'Contact non trouvé!');
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
    protected function getbrochureBySessionId()
    {
        // Récupérer tous les fichiers dans le répertoire 'uploads'
        $files = Storage::files('uploads');
        
        // Récupérer l'ID de la session
        $sessionId = session('id');

        $pattern = '/^' . preg_quote($sessionId, '/') . '-.*/';

        // Filtrer les fichiers qui commencent par l'ID de la session
        return array_filter($files, function ($file) use ($pattern) {
            // Récupérer le nom du fichier sans le chemin
            $fileName = basename($file);
            
            // Vérifier si le début du nom du fichier correspond à l'ID
            return preg_match($pattern, $fileName);
        });
    }

    protected function getbrochureId($id): array
    {
        // Récupérer tous les fichiers dans le répertoire 'uploads'
        $files = Storage::files('uploads');
        
        // Récupérer l'ID de la session
        $sessionId = $id;

        $pattern = '/^' . preg_quote($sessionId, '/') . '-.*/';

        // Filtrer les fichiers qui commencent par l'ID de la session
        return array_filter($files, function ($file) use ($pattern) {
            // Récupérer le nom du fichier sans le chemin
            $fileName = basename($file);
            
            // Vérifier si le début du nom du fichier correspond à l'ID
            return preg_match($pattern, $fileName);
        });
    }

    protected function deletebrochure($id)
    {
        // Récupérer tous les fichiers dans le répertoire 'uploads'
        $files = Storage::files('uploads');
        
        // Récupérer l'ID de la session
        $sessionId = $id;

        $pattern = '/^' . preg_quote($sessionId, '/') . '-.*/';

        // Filtrer les fichiers qui commencent par l'ID de la session
        $filesToDelete = array_filter($files, function ($file) use ($pattern) {
            // Récupérer le nom du fichier sans le chemin
            $fileName = basename($file);
            
            // Vérifier si le début du nom du fichier correspond à l'ID
            return preg_match($pattern, $fileName);
        });

        // Supprimer les fichiers filtrés
        foreach ($filesToDelete as $file) {
            Storage::delete($file);
        }
    }

    public function logout(){
        session()->flush();

        return redirect()->route('index.index');
    }

    public function detailsFournisseurs($ids)
    {
        $idsArray = explode(',', $ids);

        $fournisseurs = Fournisseur::whereIn('id', $idsArray)->get();
        $coordonnees = Coordonnee::whereIn('No_Fournisseur', $idsArray)->get()->groupBy('No_Fournisseur');
        $contacts = ContactFournisseur::whereIn('No_Fournisseur', $idsArray)->get()->groupBy('No_Fournisseur');

        // Pass the data to your view
        return view('employe.detailsFournisseurs', compact('fournisseurs', 'coordonnees', 'contacts'));
    }

    public function deleteFournisseur($sha1id){


        $ids = Fournisseur::pluck('id');

        $matchingId = $ids->first(function ($id2) use ($sha1id) {
            return hash('sha1', $id2) === $sha1id;  // Compare SHA1 hash of the ID
        });

        try{
        $this->deletebrochure($matchingId);
        modification_fournisseur::where('No_Fournisseur', $matchingId)->delete();
        Licence_Rbq::where('No_Fournisseur', $matchingId)->delete();
        Coordonnee::where('No_Fournisseur', $matchingId)->delete();
        ContactFournisseur::where('No_Fournisseur', $matchingId)->delete();
        Service::where('No_Fournisseur', $matchingId)->delete();

        Fournisseur::where('id', $matchingId)->delete();
        } catch(Exception $e){
            Log::error('Failed to fetch data:'. $e->getMessage());
        }

        return redirect()->route('index.index');
    }

}

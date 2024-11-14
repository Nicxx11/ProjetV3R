@extends('layouts.app')

@section('titre', 'Inscription')
@section('newCss', 'css/app.css')

@section('contenu')

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif
<div class="container-fluid vh-100 d-flex align-items-center justify-content-center overlay">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
    <div class="popup" id="exigences-motdepasse">
                        <div class="pointer"></div>   
                        <ol>                     
                            <li>Au moins 8 caractères</li>
                            <li>Au moins 1 lettre majuscule</li>
                            <li>Au moins 1 lettre minuscule</li>
                            <li>Au moins 1 chiffre</li>
                            <li>Au moins 1 caractère spécial</li>      
                        </ol>                 
                    </div>
        <div class="card cardColors" style="position:relative;">
            <div class="row">
            <div class="col-md-4">
                <!-- empty column -->
            </div>
            <div class="col-md-7 colInsc">
            <form action="{{ route('inscription.store') }}" method="POST">
                @csrf
                <div class="form-header pb-4 pt-4">
                    <h1 class="colInsc">Inscription</h1>
                </div>
                <!--
                    'NoCivique'=>'15700',
                    'Rue'=>'Boulevard Bécancour',
                    'Ville'=>'Trois-Rivières',
                    'Province'=>'Québec',
                    'CodePostal'=>'G9H2M1',
                    'CodeRegionAdministrative'=>'04',
                    'RegionAdministrative'=>'Mauricie',
                    'SiteInternet'=>'toto.com',
                    'TypeTelephone'=>'Bureau',
                    'Numero'=>'8192225176',
                    'Poste'=>'111'
                 -->

                <div class="form-group">
                    <label for="No_Licence_RBQ">Licence RBQ (si applicable)</label>
                    </br>
                    <input placeholder="1234-1234-12" type="text" id="No_Licence_RBQ" name="No_Licence_RBQ" value="{{ old('No_Licence_RBQ') }}">
                    </br>
                    <button type="button" onclick="checkRBQ(document.getElementById('No_Licence_RBQ').value)">Vérifier</button>
                    
                    <p class="erreur" id="erreurRBQ" style="display:none;">Licence non trouvée</p>
                </div>

                <!-- les valeurs sorties du check pour la rbq -->
                <input name="Statut" type="hidden" id="Statut" style="display:none;">
                <input name="TypeLicence" type="hidden" id="TypeLicence" style="display:none;">
                <input name="Categorie" type="hidden" id="Categorie" style="display:none;">
                <input name="Code_Sous_Categorie" type="hidden" id="Code_Sous_Categorie" style="display:none;">
                <input name="Travaux_Permis" type="hidden" id="Travaux_Permis" style="display:none;">

                <div class="form-group mt-4">
                    <label for="NEQ">NEQ:</label></br>
                    <input placeholder="NEQ" type="text" id="NEQ" name="NEQ" value="{{ old('NEQ') }}">
                    @error('NEQ')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="Courriel">Courriel:</label></br>
                    <input placeholder="Courriel de la compagnie" type="text" id="Courriel" name="Courriel"
                        value="{{ old('Courriel') }}">
                    @error('Courriel')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="Entreprise">Entreprise:</label></br>
                    <input placeholder="Nom complet de l'entreprise" type="text" id="Entreprise" name="Entreprise"
                        value="{{ old('Entreprise') }}">
                    @error('Entreprise')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="MotDePasse">Mot de passe:</label><br>
                    <input placeholder="Mot de passe sécuritaire" type="password" id="MotDePasse" name="MotDePasse"
                        aria-describedby="exigences-motdepasse">
                    @error('MotDePasse')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="MotDePasse">Confirmation mot de passe:</label></br>
                    <input placeholder="Confirmer votre mot de passe" type="password" id="MotDePasse_confirmation" name="MotDePasse_confirmation">
                    @error('MotDePasse')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="NoCivique">Numéro Civique:</label></br>
                    <input placeholder="Numéro Civique" type="text" id="NoCivique" name="NoCivique">
                    @error('NoCivique')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="Rue">Rue:</label></br>
                    <input placeholder="Rue" type="text" id="Rue" name="Rue">
                    @error('Rue')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="form-group mt-4">
                    <label for="CodePostal">Code Postal:</label></br>
                    <input placeholder="Code Postal" type="text" id="CodePostal" name="CodePostal">
                    @error('CodePostal')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                
                
                <div class="form-group mt-4">
                    <label for="Province">Province:</label></br>
                    <select id="Province" name="Province">
                        <option>Alberta</option>
                        <option>Colombie-Britannique</option>
                        <option>Île-du-Prince-Édouard</option>
                        <option>Manitoba</option>
                        <option>Nouveau-Brunswick</option>
                        <option>Nouvelle-Écosse</option>
                        <option>Ontario</option>
                        <option selected>Québec</option>
                        <option>Saskatchewan</option>
                        <option>Terre-Neuve-et-Labrador</option>
                        <option>Nunavut</option>
                        <option>Territoires du Nord-Ouest</option>
                        <option>Yukon</option>
                    </select>
                    @error('Province')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                
                
                <div class="form-group mt-4" id="VilleContainer">
                    <label for="Ville">Ville:</label></br>
                    <select id="Ville" name="Ville">
                        
                    </select>
                    @error('Ville')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mt-4" id="VilleContainerText">
                    <label for="Ville">Ville:</label></br>
                    <input placeholder="Ville" type="text" id="villeText" name="villeText">
                    @error('Ville')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>


                <div class="form-group mt-4">
                    <label for="Numero">Téléphone:</label></br>
                    <input placeholder="Numero" type="text" id="Numero" name="Numero">
                    @error('Numero')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="TypeTelephone">Type de téléphone:</label></br>
                    <select id="TypeTelephone" name="TypeTelephone">
                        <option>Cellulaire</option>
                        <option>Bureau</option>
                        <option>Télécopieur</option>
                    </select>
                    @error('TypeTelephone')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="Poste">Poste (si applicable):</label></br>
                    <input placeholder="Poste" type="text" id="Poste" name="Poste">
                    @error('Poste')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="Details">Détails:</label></br>
                    <textarea class="textDetail" rows="3" style="resize:none;" id="Details" name="Details">{{ old('Details') }}</textarea>
                    @error('Details')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <a href="{{ route('index.index') }}"><button class="marginRT px-2 py-1" type="button">Retour</button></a>
                <button class="mb-4 px-2 py-1" type="submit">Suivant</button>
            </form>

            </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
<script src="{{ asset('js/inscription.js') }}" type="module"></script>
<script>
    function changeSelectedOptionByValue(selectElement, value) {
        const option = Array.from(selectElement.options).find(option => option.value === value);
    
        if (option) {
            selectElement.value = value;
        }
    }

    function getProvince(provinceAbbr){
        if(provinceAbbr !== 'QC'){
            document.getElementById('VilleContainer').style.display = 'none';
            document.getElementById('VilleContainerText').style.display = 'block';
        } else {
            document.getElementById('VilleContainer').style.display = 'block';
            document.getElementById('VilleContainerText').style.display = 'none';
        }


        switch(provinceAbbr){
            case 'AB': return 'Alberta';
            case 'BC': return 'Colombie-Britannique';
            case 'PE': return 'Île-du-Prince-Édouard';
            case 'MB': return 'Manitoba';
            case 'NB': return 'Nouveau-Brunswick';
            case 'NS': return 'Nouvelle-Écosse';
            case 'ON': return 'Ontario';
            case 'QC': return 'Québec';
            case 'SK': return 'Saskatchewan';
            case 'NL': return 'Terre-Neuve-et-Labrador';
            case 'NU': return 'Nunavut';
            case 'NT': return 'Territoires du Nord-Ouest';
            case 'YT': return 'Yukon';
        }
    }

    function checkRBQ(rbq) {
        fetch('/check-rbq', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Send CSRF token
          },
          body: JSON.stringify({ rbq: rbq }) // send rbq value as json for Request object
        })
        .then(response => response.json()) // parse to json
        .then(data => {
          if (data.message) {
            console.log(data.message); // if no data
            document.getElementById('erreurRBQ').style = "display:block";

            document.getElementById('Statut') = '';
            document.getElementById('TypeLicence') = '';
            document.getElementById('Categorie') = '';
            document.getElementById('Code_Sous_Categorie') = '';
            document.getElementById('Adresse') = '';
            document.getElementById('CodePostal') = '';
          } else {

            console.log('Data:', data[0]); 

            document.getElementById('NEQ').value = data[0]["NEQ"];
            document.getElementById('Courriel').value = data[0]["Courriel"];
            document.getElementById('Entreprise').value = data[0]["Nom de l'intervenant"];
            document.getElementById('Numero').value = data[0]["Numero de telephone"];
            document.getElementById('erreurRBQ').style = "display:none";
            


    
            if(data[0]["Statut de la licence"] == "Active")
                document.getElementById('Statut').value = "Valide";
            else
                document.getElementById('Statut').value = data[0]["Statut de la licence"];
    
                
            document.getElementById('TypeLicence').value = data[0]["Type de licence"];
            document.getElementById('Categorie').value = data[0]["Categorie"];
            document.getElementById('Code_Sous_Categorie').value = data[0]["Sous-categories"];

            let code_postal = data[0]["Adresse"];
            code_postal = code_postal.slice(-7).replace(/ /g, '');
            document.getElementById('CodePostal').value = code_postal;

            let no_civique = data[0]["Adresse"];
            no_civique = no_civique.match(/^\d+/);
            document.getElementById('NoCivique').value = no_civique;

            let rue = data[0]["Adresse"];
            rue = rue.slice(0, rue.length -17);
            rue = rue.replace(/^[^a-zA-Z]*/, '');
            document.getElementById('Rue').value = rue;

            let province = data[0]["Adresse"];
            province = province.slice(province.length -17, province.length -15);
            console.log(province);
            province = getProvince(province);
            selectProvince = document.getElementById('Province');
            changeSelectedOptionByValue(selectProvince, province);

          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
      }
</script>
@endsection
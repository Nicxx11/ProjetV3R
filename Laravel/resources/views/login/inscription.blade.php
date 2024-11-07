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
                    <label for="RBQ">Licence RBQ (si applicable)</label>
                    </br>
                    <input placeholder="1234-1234-12" type="text" id="no_rbq" name="no_rbq" value="{{ old('RBQ') }}">
                    </br>
                    <button type="button" onclick="checkRBQ(document.getElementById('no_rbq').value)">Vérifier</button>
                    
                    @error('RBQ')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>


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
                <!-- <div class="form-group mt-4">
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
                    <label for="Ville">Ville:</label></br>
                    <input placeholder="Ville" type="text" id="Ville" name="Ville">
                    @error('Ville')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="Province">Province:</label></br>
                    <input placeholder="Province" type="text" id="Province" name="Province">
                    @error('Province')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div> -->
                <div class="form-group mt-4">
                    <label for="CodePostal">Code Postal:</label></br>
                    <input placeholder="Code Postal" type="text" id="CodePostal" name="CodePostal">
                    @error('CodePostal')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="RegionAdministrative">Région administrative:</label></br>
                    <select id="RegionAdministrative" name="RegionAdministrative">
                        <option disabled selected>--Choisir une région--</option>
                        <option>Bas-Saint-Laurent</option>
                        <option>Saguenay-Lac-Saint-Jean</option>
                        <option>Capitale-Nationale</option>
                        <option>Mauricie</option>
                        <option>Estrie</option>
                        <option>Montréal</option>
                        <option>Outaouais</option>
                        <option>Abitibi-Témiscamingue</option>
                        <option>Côte-Nord</option>
                        <option>Nord-du-Québec</option>
                        <option>Gaspésie-Îles-de-la-Madeleine</option>
                        <option>Chaudière-Appalaches</option>
                        <option>Laval</option>
                        <option>Lanaudière</option>
                        <option>Laurentides</option>
                        <option>Montérégie</option>
                        <option>Centre-du-Québec</option>
                    </select>
                    @error('RegionAdministrative')
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
          } else {
            console.log('Data:', data[0]); 

            document.getElementById('NEQ').value = data[0]["NEQ"];
            document.getElementById('Courriel').value = data[0]["Courriel"];
            document.getElementById('Entreprise').value = data[0]["Nom de l'intervenant"];
            document.getElementById('RegionAdministrative').value = data[0]["Region administrative"];
            document.getElementById('Numero').value = data[0]["Numero de telephone"];
            
            let code_postal = data[0]["Adresse"];
            code_postal = code_postal.match(/.{7}$/)[0];
            code_postal = code_postal.replace(/ /g, '');
            document.getElementById('CodePostal').value = code_postal;



          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
      }
</script>
@endsection
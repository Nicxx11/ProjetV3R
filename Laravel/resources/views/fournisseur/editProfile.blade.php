@extends('layouts.app')

@section('titre', 'Edit profile')
@section('newCss', asset('css/profileFournisseur.css'))

@section('contenu')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 text-left filter_box">
            <div class="m-4 fixedTitle">
                <h5>Modification de {{ $fournisseur->Entreprise }}</h5>
                <a href="/Fournisseurs/Profile/Delete/{{ hash('sha1', $fournisseur->id)}}" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre dossier ?');">Supprimer le dossier</a>
            </div>
        </div>

        <div class="col-md-9">
            <!-- Form start -->
            <form action="{{ route('profile.edit') }}" method="POST">
                @csrf
                <h2>Information du profil</h2>
                <button class="mb-4 px-2 py-1" type="submit">Confirmer</button>

                <div class="row m-4">
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-header">
                                État de la demande
                            </div>
                            <div class="card-body">
                                @if ($fournisseur->Etat_Demande == 'Acceptée')
                                    <i class="fa-regular fa-circle-check pe-2"></i> {{ $fournisseur->Etat_Demande }}
                                @elseif ($fournisseur->Etat_Demande == 'En attente')
                                    <i class="fa-regular fa-clock pe-2"></i>{{ $fournisseur->Etat_Demande }}
                                @elseif ($fournisseur->Etat_Demande == 'Refusée')
                                    <i class="fa-regular fa-circle-xmark pe-2"></i>{{ $fournisseur->Etat_Demande }}
                                @else
                                    <i class="fa-regular fa-pen-to-square pe-2"></i>{{ $fournisseur->Etat_Demande }}
                                @endif
                            </div>
                        </div>
                        <div class="card cardInfo">
                            <div class="card-header">
                                Identification
                            </div>
                            <div class="card-body">
                                <p>NEQ: {{ $fournisseur->NEQ }}</p>
                                <label for="NEQ">Nom: </label>
                                <input type="text" id="entreprise" name="entreprise"
                                    value="{{ $fournisseur->Entreprise }}">
                            </div>
                        </div>
                        <div class="card cardInfo">
                            <div class="card-header">
                                Adresse
                            </div>
                            <div class="card-body">
                                <p><input type="number" id="noCivic" name="noCivic" value="{{$coord->NoCivique}}">,
                                    <input type="text" id="rue" name="rue" value="{{$coord->Rue}}">
                                    </br><input type="text" id="ville" name="ville" value="{{$coord->Ville}}"> (<input
                                        type="text" id="province" name="province" value="{{$coord->Province}}">) <input
                                        type="text" id="codePostal" name="codePostal" value="{{$coord->CodePostal}}">
                                    </br></br><i class="fa-solid fa-envelope"></i> <input type="text" id="courriel"
                                        name="courriel" value="{{$fournisseur->Courriel}}">
                                    </br> <!-- ICI SE TROUVE LE IF POUR LES ICONS -->
                                    @if ($coord->TypeTelephone == 'Bureau')
                                        <i class="fa-solid fa-phone"></i>
                                    @elseif ($coord->TypeTelephone == 'Télécopieur')
                                        <i class="fa-solid fa-fax"></i>
                                    @elseif ($coord->TypeTelephone == 'Cellulaire')
                                        <i class="fa-solid fa-mobile-screen"></i>
                                    @endif
                                    <input type="number" id="coordNum" name="coordNum" value="{{$coord->Numero}}">
                                    @if ($coord->Poste != '')
                                            Poste: <input type="number" id="numPoste" name="numPoste" value="{{$coord->Poste}}">
                                        </p>
                                    @else
                                        </p>
                                    @endif
                                </p>
                            </div>
                        </div>
                        </form>
                        <div class="card cardInfo">
                            <div class="card-header">
                                Contacts
                            </div>
                            <div class="card-body">
                                @if($contactFourni && $contactFourni->isNotEmpty())
                                @foreach($contactFourni as $contact)
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <input type="hidden" name="contactId[]" value="{{ $contact->id }}">
                                            <p>Prenom: <input type="text" name="contactPrenom[{{ $contact->id }}]"
                                                    value="{{ $contact->Prenom }}">
                                                Nom: <input type="text" name="contactNom[{{ $contact->id }}]"
                                                    value="{{ $contact->Nom }}"></p>
                                            <p>Fonction: <input type="text" name="contactFonction[{{ $contact->id }}]"
                                                    value="{{ $contact->Fonction }}"></p>
                                            <p><i class="fa-solid fa-envelope"></i> <input type="email"
                                                    name="contactCourriel[{{ $contact->id }}]"
                                                    value="{{ $contact->Courriel }}"></p>
                                            <p><i class="fa-solid fa-phone"></i> <input type="number"
                                                    name="contactNumero[{{ $contact->id }}]" value="{{ $contact->Numero }}">
                                                @if ($contact->Poste != '')
                                                    Poste: <input type="number" name="contactPoste[{{ $contact->id }}]"
                                                        value="{{ $contact->Poste }}">
                                                @endif
                                                <p><a href="{{ route('profile.supprimer', ['contactId' => $contact->id]) }}" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?');">
                                                    <button type="button">Supprimer</button>
                                                </a></p>                                   
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <div id="noContact">
                                    <p>Aucun contact</p>
                                </div>
                                @endif
                                <button type="button" id="ajoutBtn">Ajouter un contact</button>
                                <div id="ajoutContact">
                                    <div class="card mb-2">
                                        <div class="card-body">

                                        <!-- Ajout non fonctionnel (double form)-->
                                        <form action="{{ route('profile.ajouter') }}" method="POST">
                                        @csrf
                                        <p><label for="Prenom">Prénom</label>
                                            <input type="text" name="Prenom" required>

                                            <label for="Nom">Nom</label>
                                            <input type="text" name="Nom" required></p>

                                            <p><label for="Fonction">Fonction</label>
                                            <input type="text" name="Fonction"></p>

                                            <p><i class="fa-solid fa-envelope"> </i><label for="Courriel">Courriel</label>
                                            <input type="email" name="Courriel"></p>

                                            <p><i class="fa-solid fa-phone"> </i><label for="Numero">Numéro</label>
                                            <input type="number" name="Numero">
                                        
                                            <label for="type">Type</label>
                                            <select name="type">
                                                <option disabled selected>Default</option>
                                                <option>Bureau</option>
                                                <option>Cellulaire</option>
                                                <option>Télécopieur</option>
                                            </select></p>

                                            <label for="Poste">Poste</label>
                                            <input type="number" name="Poste"></br>
                                            
                                            </br><button type="submit">Ajouter</button>
                                            </a>  
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Produits et services offerts
                            </div>
                            <div class="card-body">
                                <h3>Approvisionnements</h3>

                                @foreach ($service->groupBy('Code_Categorie') as $codeCategorie => $services)
                                    <h3>{{ $codeCategorie }} - {{ $services->first()->Categorie }}</h3>

                                    @foreach ($services as $ser)
                                        <p>{{ $ser->UNSPSC }} - {{ $ser->Description }}</p>
                                    @endforeach
                                @endforeach
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Details et spécifications
                                    </div>
                                    <div class="card-body">
                                        <p>Details: {{ $fournisseur->Details }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card cardInfo">
                            <div class="card-header">
                                Licence(s) RBQ
                            </div>
                            <div class="card-body">
                                @if(isset($licRbq[0]))
                                    <p>{{$licRbq[0]->No_Licence_RBQ}} {{ $licRbq[0]->TypeLicence }} {{ $licRbq[0]->Statut }}
                                @endif
                                </p>
                                <div class="card">
                                    <div class="card-header">
                                        Catégories et sous-catégories autorisées
                                    </div>
                                    <div class="card-body">
                                        @if ($licRbq->contains('Categorie', 'Général'))
                                            <h3>CATÉGORIE ENTREPRENEUR GÉNÉRAL</h3>
                                        @endif
                                        @foreach ($licRbq as $lic)
                                            @if ($lic->Categorie == "Général")
                                                <p>{{ $lic->Code_Sous_Categorie }} {{ $lic->Travaux_Permis }}</p>
                                            @endif
                                        @endforeach
                                        @if ($licRbq->contains('Categorie', 'Spécialisé'))
                                            <h3>CATÉGORIE ENTREPRENEUR SPÉCIALISÉ</h3>
                                        @endif
                                        @foreach ($licRbq as $lic)
                                            @if ($lic->Categorie == "Spécialisé")
                                                {{ $lic->Code_Sous_Categorie }} {{ $lic->Travaux_Permis }}</br>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card cardInfo">
                            <div class="card-header">
                                Brochures et cartes d'affaire
                            </div>
                            <div class="card-body">
                                <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="brochure">Choisir un fichier :</label>
                                    <input type="file" name="brochure" id="brochure" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if ($fournisseur->Etat_Demande == 'Acceptée')
                            <div class="card">
                                <div class="card-header">
                                    Finances
                                </div>
                                <div class="card-body">
                                    <p>Numéro TPS: {{ $fournisseur->No_TPS }}</p>
                                    <p>Numéro TVQ: {{ $fournisseur->No_TVQ }}</p>
                                    <p>Condition de paiement: {{ $fournisseur->Conditions_Paiement }}</p>
                                    <p>Devis: {{ $fournisseur->Devise }}</p>
                                    <p>Mode de communication: {{ $fournisseur->Mode_Communication }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('js/editProfile.js') }}"></script>
@extends('layouts.app')

@section('titre', 'Edit profile')
@section('newCss', asset('css/profileFournisseur.css'))

@section('contenu')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 text-left filter_box">
            <div class="m-4 fixedTitle">
                <h5>Modification de {{ $fournisseur->Entreprise }}</h5>
                <a href="/Fournisseurs/Profile/Delete/{{ hash('sha1', $fournisseur->id)}}" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre dossier ?');"><button type="button">Supprimer le dossier</button></a>
            </div>
        </div>

        <div class="col-md-9">
            <!-- Form start -->
            @if(session('Role') == 'Responsable' || session('Role') == 'Administrateur')
                <form action="{{ route('fournisseur.updateProfileUser') }}" method="POST">
            @else
                <form action="{{ route('profile.edit') }}" method="POST">
            @endif
                @csrf
                <input type="hidden" value="{{ $fournisseur->id }}" name="idFournisseur">
                <h2>Information du profil</h2>
                <button class="mb-4 px-2 py-1" type="submit">Confirmer</button>

                <div class="row m-4">
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-header">
                                État de la demande
                            </div>
                            <div class="card-body">
                            @if(session('Role') == 'Responsable' || session('Role') == 'Administrateur')
                            <div id="Etat_Demande_Container">
                                <select name="Etat_Demande" id="Etat_Demande_Select">
                                    <option value="Acceptée" @if($fournisseur->Etat_Demande == 'Acceptée') selected @endif><i class="fa-regular fa-circle-check pe-2"></i> Acceptée</option>
                                    <option value="En attente" @if($fournisseur->Etat_Demande == 'En attente') selected @endif><i class="fa-regular fa-clock pe-2"></i> En attente</option>
                                    <option value="Refusée" @if($fournisseur->Etat_Demande == 'Refusée') selected @endif><i class="fa-regular fa-circle-xmark pe-2"> Refusée</i></option>
                                </select>
                                <br>
                                <br>
                                <input type="text" name="raisonRefus" placeholder="Raison du refus">
                            </div>
                            @else
                                @if ($fournisseur->Etat_Demande == 'Acceptée')
                                    <i class="fa-regular fa-circle-check pe-2"></i> {{ $fournisseur->Etat_Demande }}
                                @elseif ($fournisseur->Etat_Demande == 'En attente')
                                    <i class="fa-regular fa-clock pe-2"></i>{{ $fournisseur->Etat_Demande }}
                                @elseif ($fournisseur->Etat_Demande == 'Refusée')
                                    <i class="fa-regular fa-circle-xmark pe-2"></i>{{ $fournisseur->Etat_Demande }}
                                @else
                                    <i class="fa-regular fa-pen-to-square pe-2"></i>{{ $fournisseur->Etat_Demande }}
                                @endif
                            @endif
                            </div>
                        </div>
                        <div class="card cardInfo">
                            <div class="card-header">
                                Identification
                            </div>
                            <div class="card-body">
                                @if($fournisseur->NEQ != null)
                                    <p>NEQ: {{ $fournisseur->NEQ }}</p>
                                @endif
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
                                            </p>
                                            <p>
                                                Nom: <input type="text" name="contactNom[{{ $contact->id }}]"
                                                    value="{{ $contact->Nom }}">
                                            </p>
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
                            <a class="m-3" href="/Service/Add/{{$fournisseur->id}}"><button type="button">Ajouter un service</button></a>
                            @if(session('messageDetails'))
                                <p class="alert">
                                    {{ session('messageDetails') }}
                                </p>
                            @endif
                            <div class="card-body">
                                <h3>Approvisionnements</h3>

                                @foreach ($service->groupBy('Code_Categorie') as $codeCategorie => $services)
                                    <h3>{{ $codeCategorie }} - {{ $services->first()->Categorie }}</h3>

                                    @foreach ($services as $ser)
                                        <p>{{ $ser->UNSPSC }} - {{ $ser->Description }} <a href="{{ route('service.delete', ['id' => hash('sha1',$ser->id)]) }}"><button type="button">Supprimer</button></a></p>
                                    @endforeach
                                @endforeach
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Details et spécifications
                                    </div>
                                    <form action="{{ route('details.update') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <input type="hidden" name="idFournisseur" value="{{$fournisseur->id}}">
                                        <p>Details: <textarea type="text" name="Details">{{ $fournisseur->Details }}</textarea></p>
                                        <button onclick="">Mettre à Jour les détails</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card cardInfo">
                            <div class="card-header">
                                Licence(s) RBQ
                            </div>
                            <div class="card-body">
                                
                                @if(isset($licRbq))
                                    @foreach($licRbq as $lic)
                                        <p>{{$lic->No_Licence_RBQ}} {{ $lic->TypeLicence }} {{ $lic->Statut }} <a href="{{ route('rbq.delete', ['id' => hash('sha1',$lic->id)]) }}"><button type="button">Supprimer</button></a></p>
                                    @endforeach
                                @endif
                                @if(session('messageRBQ'))
                                    <div class="alert">
                                        {{ session('messageRBQ') }}
                                    </div>
                                @endif
                                <div class="card">
                                    <div class="card-header">
                                        Catégories et sous-catégories autorisées
                                    </div>
                                    <div class="card-body">
                                    <form action="{{ route('rbq.add') }}" method="POST">
                                    @csrf
                                        
                                    
                                        <input type="hidden" value="{{$fournisseur->id}}" name="idFournisseur">
                                        <p>Numéro de licence: <input type="text" name="No_Licence_RBQ"></p>
                                        @error('No_Licence_RBQ')
                                            <p class="erreur">{{ $message }}</p>
                                        @enderror

                                        <p>Statut de la licence: <select name="Statut">
                                            <option>Valide</option>
                                            <option>Valide avec restriction</option>
                                            <option>Non valide</option>
                                        </select></p>
                                        @error('Statut')
                                            <p class="erreur">{{ $message }}</p>
                                        @enderror

                                        <p>Type de licence: <select name="TypeLicence">
                                            <option>Entrepreneur</option>
                                            <option>Contructeur-Propriétaire</option>
                                        </select></p>
                                        @error('TypeLicence')
                                            <p class="erreur">{{ $message }}</p>
                                        @enderror

                                        <p>Categorie de licence: <select name="Categorie">
                                            <option>Général</option>
                                            <option>Spécialisé</option>
                                        </select></p>
                                        @error('Categorie')
                                            <p class="erreur">{{ $message }}</p>
                                        @enderror

                                        <p>Travaux Permis: <select name="Travaux_Permis">
                                            @foreach($categoriesRbqs as $cat)
                                                <option>{{$cat->Code_Sous_Categorie}}</option>
                                            @endforeach
                                        </select></p>
                                        @error('Travaux_Permis')
                                            <p class="erreur">{{ $message }}</p>
                                        @enderror
                                        
                                        <button>Ajouter</button>
                                        
                                    </form>
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
                                    <form action="{{ route('finances.upload') }}" method="POST">
                                    @csrf
                                    
                                    <input type="hidden" value="{{$fournisseur->id}}" name="idFournisseur">
                                        <p>Numéro TPS: <input type="text" name="No_TPS" value="{{$fournisseur->No_TPS}}"></p>
                                        @error('No_TPS')
                                            <p class="erreur">{{ $message }}</p>
                                        @enderror
                                        <p>Numéro TVQ: <input type="text" name="No_TVQ" value="{{$fournisseur->No_TVQ}}"></p>
                                        @error('No_TVQ')
                                            <p class="erreur">{{ $message }}</p>
                                        @enderror
                                        <p>Condition de paiement: <select name="Conditions_Paiement" value="{{$fournisseur->Conditions_Paiement}}">
                                            <option value="Z001">Z001 - payable immédiatement sans déduction</option>
                                            <option value="Z115">Z115 - payable immédiatement sans déduction, Date de base au 15 du mois suivant</option>
                                            <option value="Z152">Z152 - dans les 15 jours 2% escpte, dans les 30 jours sans déduction</option>
                                            <option value="Z153">Z153 - après entrée facture jusqu'au 15 du mois, jusqu'au 15 du mois suivant es...</option>
                                            <option value="Z210">Z210 - dans les 10 jours 2% escpte, dans les 30 jours sans déduction</option>
                                            <option value="ZT15">ZT15 - dans les 15 jours sans déduction</option>
                                            <option value="ZT30">ZT30 - dans les 30 jours sans déduction</option>
                                            <option value="ZT45">ZT45 - dans les 45 jours sans déduction</option>
                                            <option value="ZT60">ZT60 - dans les 60 jours sans déduction</option>
                                        </select></p>
                                        @error('Conditions_Paiement')
                                            <p class="erreur">{{ $message }}</p>
                                        @enderror
                                        <p>Devise: <select name="Devise" value="{{$fournisseur->Devise}}">
                                            <option value="CAD">CAD - Dollar canadien</option>
                                            <option value="USD">USD - Dollar des États-Unis</option>
                                        </select></p>
                                        @error('Devise')
                                            <p class="erreur">{{ $message }}</p>
                                        @enderror
                                        <p>Mode de communication: <select name="Mode_Communication" value="{{$fournisseur->Mode_Communication}}">
                                            <option>Courriel</option>
                                            <option>Courrier régulier</option>
                                        </select></p>
                                        @error('Mode_Communication')
                                            <p class="erreur">{{ $message }}</p>
                                        @enderror
                                        <button>Soumettre</button>
                                        @if(session('messageFinances'))
                                        <div class="alert">
                                            {{ session('messageFinances') }}
                                        </div>
                                        @endif
                                    </form>
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
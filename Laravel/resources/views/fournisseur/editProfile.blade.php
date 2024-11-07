@extends('layouts.app')

@section('titre','Edit profile')
@section('newCss','../css/profileFournisseur.css')

@section('contenu')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 text-left filter_box"> 
            @csrf
            <div class="m-4 fixedTitle">
                <h5>Modification de {{ $fournisseur->Entreprise }}</h5>
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
                            <input type="text" id="entreprise" name="entreprise" value="{{ $fournisseur->Entreprise }}">
                        </div>
                    </div>
                    <div class="card cardInfo">
                    <div class="card-header">
                            Adresse
                        </div>
                        <div class="card-body">
                            <p><input type="number" id="noCivic" name="noCivic" value="{{$coord->NoCivique}}">, <input type="text" id="rue" name="rue" value="{{$coord->Rue}}">
                            </br><input type="text" id="ville" name="ville" value="{{$coord->Ville}}"> (<input type="text" id="province" name="province" value="{{$coord->Province}}">) <input type="text" id="codePostal" name="codePostal" value="{{$coord->CodePostal}}">
                            </br></br><i class="fa-solid fa-envelope"></i> <input type="text" id="courriel" name="courriel" value="{{$fournisseur->Courriel}}">
                            </br>                            <!-- ICI SE TROUVE LE IF POUR LES ICONS -->
                            @if ($coord->TypeTelephone == 'Bureau')
                            <i class="fa-solid fa-phone"></i>
                            @elseif ($coord->TypeTelephone == 'Télécopieur')
                            <i class="fa-solid fa-fax"></i>
                            @elseif ($coord->TypeTelephone == 'Cellulaire')
                            <i class="fa-solid fa-mobile-screen"></i>
                            @endif
                            <input type="number" id="coordNum" name="coordNum" value="{{$coord->Numero}}">
                            @if ($coord->Poste != '')
                                    Poste: <input type="number" id="numPoste" name="numPoste" value="{{$coord->Poste}}"></p>
                                    @else
                                    </p>
                                    @endif
                            </p>
                        </div>
                    </div>
                    <div class="card cardInfo">   
                        <div class="card-header">
                            Contacts
                        </div>
                        <div class="card-body">
                        
                        @foreach($contactFourni as $contact)
                            <div class="card mb-2">   
                                <div class="card-body">
                                    <p>Prenom: <input type="text" id="contactPrenom" name="contactPrenom" value="{{ $contact->Prenom }}"> Nom: <input type="text" id="contactNom" name="contactNom" value="{{ $contact->Nom }}"></p>
                                    <p>Fonction: <input type="text" id="contactFonction" name="contactFonction" value="{{ $contact->Fonction }}"></p>
                                    <p><i class="fa-solid fa-envelope"></i> <input type="email" id="contactCourriel" name="contactCourriel" value="{{ $contact->Courriel }}"></p>
                                    <p><i class="fa-solid fa-phone"></i> <input type="number" id="contactNumero" name="contactNumero" value="{{ $contact->Numero }}"> 
                                    @if ($contact->Poste != '')
                                    Poste: <input type="number" id="contactFonction" name="contactFonction" value="{{ $contact->Poste }}"></p>
                                    @else
                                    </p>
                                    @endif
                                    
                                </div>                 
                            </div>
                        @endforeach
                        
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
                            License RBQ
                        </div>
                        <div class="card-body">
                            <p>{{$licRbq[0]->No_Licence_RBQ}} {{ $licRbq[0]->TypeLicence }} {{ $licRbq[0]->Statut }}</p>
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
                            Place Holder
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
            </form>
        </div>
    </div>
</div>


@endsection
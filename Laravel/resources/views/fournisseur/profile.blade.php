@extends('layouts.app')

@section('titre', 'Profile')
@section('newCss', asset('css/profileFournisseur.css'))

@section('contenu')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 text-left filter_box">
            @csrf
            <div class="m-4 fixedTitle">
                <h5>Bienvenue {{ $fournisseur->Entreprise }}</h5>
            </div>
        </div>

        <div class="col-md-9">
            <h2>Information du profil</h2>
            <a href="{{ route('profile.modifier') }}"><button>Modifier</button></a>
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
                            <p>Nom: {{ $fournisseur->Entreprise }}</p>
                        </div>
                    </div>
                    <div class="card cardInfo">
                        <div class="card-header">
                            Adresse
                        </div>
                        <div class="card-body">
                            <p>{{$coord->NoCivique}}, {{$coord->Rue}}
                                </br>{{$coord->Ville}} ({{$coord->Province}}) {{$coord->CodePostal}}
                                </br></br><i class="fa-solid fa-envelope"></i> {{$fournisseur->Courriel}}
                                </br> <!-- ICI SE TROUVE LE IF POUR LES ICONS -->
                                @if ($coord->TypeTelephone == 'Bureau')
                                    <i class="fa-solid fa-phone"></i>
                                @elseif ($coord->TypeTelephone == 'Télécopieur')
                                    <i class="fa-solid fa-fax"></i>
                                @elseif ($coord->TypeTelephone == 'Cellulaire')
                                    <i class="fa-solid fa-mobile-screen"></i>
                                @endif
                                {{$coord->Numero}}
                                @if ($coord->Poste != '')
                                        #{{$coord->Poste}}
                                    </p>
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
                                        <p>{{ $contact->id }}</p>
                                        <p>{{ $contact->Prenom }} {{ $contact->Nom }}</p>
                                        <p>{{ $contact->Fonction }}</p>
                                        <p><i class="fa-solid fa-envelope"></i> {{ $contact->Courriel }}</p>
                                        <p><i class="fa-solid fa-phone"></i> {{ $contact->Numero }}
                                            @if ($contact->Poste != '')
                                                    #{{$contact->Poste}}
                                                </p>
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
        </div>
    </div>
</div>


@endsection
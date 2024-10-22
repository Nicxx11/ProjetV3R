@extends('layouts.app')

@section('titre','Profile')
@section('newCss','../css/profileFournisseur.css')

@section('contenu')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 text-left filter_box"> <!--Filtres et Recherches-->
            @csrf
            <div class="m-4">
                <h5>Bienvenue {{ $fournisseur->Entreprise }}</h5>
            </div>
        </div>

        <div class="col-md-9"> <!--Barre de navigation et Tableau-->
        <h2>Information du profil</h2>
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
                            <p>Courriel: {{ $fournisseur->Courriel }}</p>
                        </div>
                    </div>
                    <div class="card cardInfo">
                    <div class="card-header">
                            Adresse
                        </div>
                        <div class="card-body">
                            <!-- adresse ici -->
                            Je suis une adresse!
                        </div>
                    </div>
                    <div class="card cardInfo">   
                        <div class="card-header">
                            Contacts
                        </div>
                        <div class="card-body">
                        @foreach($contactFourni as $contact)
                            <div class="card">   
                                <div class="card-body">
                                    {{$contact->No_Fournisseur}} - {{ $contact->Prenom}}
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
                            <p>Place Holder</p>
                            <div class="card">   
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
                            <p>Place Holder</p>
                            <div class="card">   
                                <div class="card-header">
                                    Catégories et sous-catégories autorisées
                                </div>
                                <div class="card-body">
                                    <p>Place Holder</p>
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
                    <div class="card">
                    <div class="card-header">
                            Finances
                        </div>
                        <div class="card-body">
                            <p>Numéro TPS: {{ $fournisseur->No_TPS }}</p>
                            <p>Numéro TVQ: {{ $fournisseur->No_TVQ }}</p>
                            <p>Condition de paiement: {{ $fournisseur->Conditions_paiement }}</p>
                            <p>Devis: {{ $fournisseur->Devise }}</p>
                            <p>Mode de communication: {{ $fournisseur->Mode_Communication }}</p>
                        </div>
                        </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection
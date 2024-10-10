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

            <div class="row card m-4">
                <h2>Information du profile</h2>
            <p>Numéro NEQ: {{ $fournisseur->NEQ }}</p>
            <p>Nom de l'entreprise: {{ $fournisseur->Entreprise }}</p>
            <p>Courriel: {{ $fournisseur->Courriel }}</p>
            <p>Details: {{ $fournisseur->Details }}</p>
            <p>Numéro TPS: {{ $fournisseur->No_TPS }}</p>
            <p>Numéro TVQ: {{ $fournisseur->No_TVQ }}</p>
            <p>Condition de paiement: {{ $fournisseur->Conditions_paiement }}</p>
            <p>Devis: {{ $fournisseur->Devise }}</p>
            <p>Mode de communication: {{ $fournisseur->Mode_Communication }}</p>
            </div>
        </div>
    </div>
</div>


@endsection
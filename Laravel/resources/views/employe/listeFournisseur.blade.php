@extends('layouts.app')

@section('titre','Fournisseurs')
@section('newCss','../css/listeFournisseurs.css')

@section('contenu')
<!-- ajouter le contenu de la page ci bas -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 text-left filter_box"> <!--Filtres et Recherches-->
            @csrf
            <!--Barre de recherche-->
            <div class="m-4">
                <h5>Rechercher</h5>
                <input type="text" id="valeur_recherche" name="valeur_recherche" value="{{ old('valeur_recherche') }}">
            </div>

            <!--Bouton effacer les filtres-->
            <div class="m-4">
                <h5>X Effacer les Filtres</h5>
            </div>

            <!--Filtre de Statut-->
            <div class="card m-4 filter_card">
                <br>
                <h4 class="my-2 mx-4 filter_title etat"><i class="fa-solid fa-chevron-down fa-sm chevron"></i>  État</h4>

                <div class="d-flex align-items-center my-2 mx-4 etat_item active">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="En_attente" name="En_attente" value="En_attente">
                    <label class="form-check-label" for="En_attente">En attente</label>
                </div>

                <div class="d-flex align-items-center my-2 mx-4 etat_item active">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="Acceptees" name="Acceptees" value="Acceptees">
                    <label class="form-check-label" for="Acceptees">Acceptées</label>
                </div>

                <div class="d-flex align-items-center my-2 mx-4 etat_item active">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="Refusees" name="Refusees" value="Refusees">
                    <label class="form-check-label" for="Refusees">Refusées</label>
                </div>

                <div class="d-flex align-items-center my-2 mx-4 etat_item active">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="A_reviser" name="A_reviser" value="A_reviser">
                    <label class="form-check-label" for="A_reviser">À réviser</label>
                </div>
                <br>
            </div>

            <!--Filtre de Produit/Service-->
            <div class="card m-4 filter_card">
                <br>
                <h4 class="my-2 mx-4 titreFiltre produits_services"><i class="fa-solid fa-chevron-down fa-sm chevron"></i>  Produits et Services</h4>

                <div class="d-flex align-items-center my-2 mb-4 mx-4 produits_service_item active">
                    <input class="filter_search" type="text" id="service_recherche" name="service_recherche" value="{{ old('service_recherche') }}">
                </div>

                <div class="d-flex align-items-center mx-4 produits_service_item active">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="En_attente" name="En_attente" value="En_attente">
                    <label class="form-check-label" for="En_attente">Tonde de Pelouse</label>
                </div>

                <div class="d-flex align-items-center mx-4 produits_service_item active">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="En_attente" name="En_attente" value="En_attente">
                    <label class="form-check-label" for="En_attente">Aménagement de Pelouse</label>
                </div>

                <div class="d-flex align-items-center mx-4 produits_service_item active">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="En_attente" name="En_attente" value="En_attente">
                    <label class="form-check-label" for="En_attente">Coupe de Pelouse</label>
                </div>

                <div class="d-flex align-items-center mx-4 produits_service_item active">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="En_attente" name="En_attente" value="En_attente">
                    <label class="form-check-label" for="En_attente">Quelque chose Pelouse</label>
                </div>

                <div class="d-flex align-items-center mx-4 produits_service_item active">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="En_attente" name="En_attente" value="En_attente">
                    <label class="form-check-label" for="En_attente">Truc Pelouse</label>
                </div>

                <br>
            </div>

            <!-- -->
            
        </div>
        <div class="col-md-9"> <!--Barre de navigation et Tableau-->

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="../js/filterToggler.js" crossorigin="anonymous"></script>
@endsection
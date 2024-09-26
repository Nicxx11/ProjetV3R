@extends('layouts.app')

@section('titre','Fournisseurs')
@section('newCss','../css/listeFournisseurs.css')

@section('contenu')
<!-- ajouter le contenu de la page ci bas -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 text-left colonne_filtres"> <!--Filtres et Recherches-->
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
            <div class="card m-4">
                <br>
                <h4 class="my-2 mx-4 titreFiltre">Statut</h4>

                <div class="d-flex align-items-center my-2 mx-4">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="En_attente" name="En_attente" value="En_attente">
                    <label class="form-check-label" for="En_attente">En attente</label>
                </div>

                <div class="d-flex align-items-center my-2 mx-4">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="Acceptees" name="Acceptees" value="Acceptees">
                    <label class="form-check-label" for="Acceptees">Acceptées</label>
                </div>

                <div class="d-flex align-items-center my-2 mx-4">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="Refusees" name="Refusees" value="Refusees">
                    <label class="form-check-label" for="Refusees">Refusées</label>
                </div>

                <div class="d-flex align-items-center my-2 mx-4">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="A_reviser" name="A_reviser" value="A_reviser">
                    <label class="form-check-label" for="A_reviser">À réviser</label>
                </div>
                <br>
            </div>

            <!--Filtre de Produit/Service-->
            <div class="card m-4">
                <br>
                <h4 class="my-2 mx-4 titreFiltre">Statut</h4>

                <div class="d-flex align-items-center my-2 mx-4">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="En_attente" name="En_attente" value="En_attente">
                    <label class="form-check-label" for="En_attente">En attente</label>
                </div>

                <div class="d-flex align-items-center my-2 mx-4">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="Acceptees" name="Acceptees" value="Acceptees">
                    <label class="form-check-label" for="Acceptees">Acceptées</label>
                </div>

                <div class="d-flex align-items-center my-2 mx-4">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="Refusees" name="Refusees" value="Refusees">
                    <label class="form-check-label" for="Refusees">Refusées</label>
                </div>

                <div class="d-flex align-items-center my-2 mx-4">
                    <input class="form-check-input me-2 filter_input" type="checkbox" id="A_reviser" name="A_reviser" value="A_reviser">
                    <label class="form-check-label" for="A_reviser">À réviser</label>
                </div>
                <br>
            </div>
            
        </div>
        <div class="col-md-9"> <!--Barre de navigation et Tableau-->

        </div>
    </div>
</div>

@endsection
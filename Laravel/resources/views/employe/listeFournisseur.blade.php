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
                <div style="display:flex;">
                    <input type="text" class="recherche_fournisseur text-input" id="valeur_recherche" name="valeur_recherche" value="{{ old('valeur_recherche') }}">
                </div>
            </div>

            <!--Bouton effacer les filtres-->
            <div class="m-4">
                <h5 class="effacer-filtres"><i class="fa-solid fa-xmark"></i> Effacer les Filtres</h5>
            </div>
            <div class="scrollable-filters">
                <!--Filtre d'État-->
                <div class="card m-4 filter_card">
                    
                    <h4 class="my-2 mx-4 py-1 filter_title etat"><i class="fa-solid fa-chevron-right fa-sm"></i>  État</h4>

                    <div class="d-flex align-items-center my-2 mx-4 etat_item active">
                        <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="En_attente" name="En_attente" value="En_attente">
                        <label class="form-check-label" for="En_attente">En attente</label>
                    </div>

                    <div class="d-flex align-items-center my-2 mx-4 etat_item active">
                        <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Acceptees" name="Acceptees" value="Acceptees">
                        <label class="form-check-label" for="Acceptees">Acceptées</label>
                    </div>

                    <div class="d-flex align-items-center my-2 mx-4 etat_item active">
                        <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Refusees" name="Refusees" value="Refusees">
                        <label class="form-check-label" for="Refusees">Refusées</label>
                    </div>

                    <div class="d-flex align-items-center my-2 mx-4 etat_item active">
                        <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="A_reviser" name="A_reviser" value="A_reviser">
                        <label class="form-check-label" for="A_reviser">À réviser</label>
                    </div>
                    
                </div>

                <!--Filtre de Produit/Service-->
                <div class="card m-4 pb-2 filter_card">
                    
                    <h4 class="my-2 mx-4 pt-1 filter_title produits_services"><i class="fa-solid fa-chevron-down"></i> Produits et Services</h4>

                    <div class="d-flex align-items-center my-2 mb-4 mx-4" style="font-size:smaller">
                        <input class="filter_search text-input" type="text" id="service_recherche" name="service_recherche" value="{{ old('service_recherche') }}">
                    </div>
                    <div class="scrollable">
                        <!-- C'est  içi que les UNSPSC apparaissent -->
                    </div>
                </div>

                <!-- Filtres Sous-Catégories RBQ -->
                <div class="card m-4 filter_card">
                    <h4 class="my-2 mx-4 py-1 filter_title categories_rbqs"><i class="fa-solid fa-chevron-right"></i> Catégories de Travaux</h4>
                    <div class="scrollable categories_rbqs_item active">
                        <div class="d-flex align-items-center mx-4 categories_rbqs_item active">
                            <p class="categorie"><b>Général</b></p>
                        </div>

                        @if ($rbqs_general->isNotEmpty())
                            @foreach($rbqs_general as $rbq)
                                <div class="d-flex align-items-center mx-4 categories_rbqs_item active sous_categorie">
                                    <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="{{$rbq->Code_Sous_Categorie}}" name="{{$rbq->Code_Sous_Categorie}}" value="{{$rbq->Code_Sous_Categorie}}">
                                    <label class="form-check-label" for="{{$rbq->Code_Sous_Categorie}}">{{$rbq->Code_Sous_Categorie}}</label>
                                </div>
                            @endforeach
                        @endif
                        <div class="d-flex align-items-center mx-4 categories_rbqs_item active">
                            <p class="categorie"><b>Spécialisé</b></p>
                        </div>

                        @if ($rbqs_specialise->isNotEmpty())
                            @foreach($rbqs_specialise as $rbq)
                                <div class="d-flex align-items-center mx-4 categories_rbqs_item active sous_categorie">
                                    <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="{{$rbq->Code_Sous_Categorie}}" name="{{$rbq->Code_Sous_Categorie}}" value="{{$rbq->Code_Sous_Categorie}}">
                                    <label class="form-check-label" for="{{$rbq->Code_Sous_Categorie}}">{{$rbq->Code_Sous_Categorie}}</label>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>

                <!-- Filtres Régions Administratives -->
                <div class="card m-4 filter_card">
                    
                    <h4 class="my-2 mx-4 py-1 filter_title region_administratives"><i class="fa-solid fa-chevron-right"></i> Région Administrative</h4>
                    <div class="scrollable region_administratives_item active">
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Bas-Saint-Laurent" name="Bas-Saint-Laurent" value="Bas-Saint-Laurent">
                            <label class="form-check-label" for="Bas-Saint-Laurent">Bas-Saint-Laurent</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Saguenay-Lac-Saint-Jean" name="Saguenay-Lac-Saint-Jean" value="Saguenay-Lac-Saint-Jean">
                            <label class="form-check-label" for="Saguenay-Lac-Saint-Jean">Saguenay-Lac-Saint-Jean</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Capitale-Nationale" name="Capitale-Nationale" value="Capitale-Nationale">
                            <label class="form-check-label" for="Capitale-Nationale">Capitale-Nationale</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Mauricie" name="Mauricie" value="Mauricie">
                            <label class="form-check-label" for="Mauricie">Mauricie</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Estrie" name="Estrie" value="Estrie">
                            <label class="form-check-label" for="Estrie">Estrie</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Montréal" name="Montréal" value="Montréal">
                            <label class="form-check-label" for="Montréal">Montréal</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Outaouais" name="Outaouais" value="Outaouais">
                            <label class="form-check-label" for="Outaouais">Outaouais</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Abitibi-Témiscamingue" name="Abitibi-Témiscamingue" value="Abitibi-Témiscamingue">
                            <label class="form-check-label" for="Abitibi-Témiscamingue">Abitibi-Témiscamingue</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Côte-Nord" name="Côte-Nord" value="Côte-Nord">
                            <label class="form-check-label" for="Côte-Nord">Côte-Nord</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Nord-du-Québec" name="Nord-du-Québec" value="Nord-du-Québec">
                            <label class="form-check-label" for="Nord-du-Québec">Nord-du-Québec</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Gaspésie-Îles-de-la-Madeleine" name="Gaspésie-Îles-de-la-Madeleine" value="Gaspésie-Îles-de-la-Madeleine">
                            <label class="form-check-label" for="Gaspésie-Îles-de-la-Madeleine">Gaspésie-Îles-de-la-Madeleine</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Chaudière-Appalaches" name="Chaudière-Appalaches" value="Chaudière-Appalaches">
                            <label class="form-check-label" for="Chaudière-Appalaches">Chaudière-Appalaches</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Laval" name="Laval" value="Laval">
                            <label class="form-check-label" for="Laval">Laval</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Lanaudière" name="Lanaudière" value="Lanaudière">
                            <label class="form-check-label" for="Lanaudière">Lanaudière</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Laurentides" name="Laurentides" value="Laurentides">
                            <label class="form-check-label" for="Laurentides">Laurentides</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Montérégie" name="Montérégie" value="Montérégie">
                            <label class="form-check-label" for="Montérégie">Montérégie</label>
                        </div>
                        <div class="d-flex align-items-center mx-4 region_administratives_item active">
                            <input class="form-check-input me-2 filter_input checkbox-input" type="checkbox" id="Centre-du-Québec" name="Centre-du-Québec" value="Centre-du-Québec">
                            <label class="form-check-label" for="Centre-du-Québec">Centre-du-Québec</label>
                        </div>
                    </div>
                </div>
                <!--Filtre de Ville-->
                <div class="card m-4 pb-2 filter_card villes">
                    
                    <h4 class="my-2 mx-4 pt-1 filter_title villes_toggler"><i class="fa-solid fa-chevron-right"></i> Villes</h4>

                    <!-- Va contenir toutes les villes filtrées (filtre pas fait encore) -->
                    <div id="villes_container" class="scrollable villes_item active"></div>
                </div>
            </div>
        </div>

        <div class="col-md-9"> <!--Barre de navigation et Tableau-->

            <div class="row">
                <div class="row navbar m-4">Barre de navigation</div>
            </div>


            <div class="row">
                <table class="col-md-10 ms-5 mt-4" id="fournisseurs-table">
                    <thead>
                        <tr>
                            <th class="etat_column">État</th>
                            <th class="fournisseur_column">Fournisseur</th>
                            <th class="ville_column">Ville</th>
                            <th class="produits_services_column">Produits & Services</th>
                            <th class="categorie_column">Catégories de Travaux</th>
                            <th class="ouvrir_column">Ouvrir</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    window.Laravel = {
        fournisseurs: @json($fournisseurs),
        coordonnees: @json($coordonnees),
        services: @json($services)
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/fuse.js"></script>
<script src="../js/pageFournisseurs.js" crossorigin="anonymous" defer></script>
@endsection
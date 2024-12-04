@extends('layouts.app')

@section('titre', 'Profile')
@section('newCss', asset('css/profileFournisseur.css'))

@section('contenu')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 text-left filter_box">
            @csrf
            <div class="m-4 fixedTitle">
                
                    <a @if(session('Role') == 'Commis')href="{{ route('fournisseurs.listcommis') }}" @else href="{{ route('fournisseurs.list') }}" @endif class="mt-5 ms-5"><button type="button">Retour</button></a>           
                
            </div>
        </div>

        <div class="col-md-9">
            <h2>Information du profil</h2>
            @if(session('Role') == 'Responsable' || session('Role') == 'Administrateur')
                <a href="{{ route('fournisseur.editProfileUser', ['id' => hash('sha1', $fournisseur->id)]) }}"><button>Modifier</button></a>
            @endif
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
                            @if($fournisseur->NEQ != null)
                                <p>NEQ: {{ $fournisseur->NEQ }}</p>
                            @endif
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
                                </br>
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
                            @if($contactFourni && $contactFourni->isNotEmpty())
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
                            @else
                                <p>Aucun contact</p>
                            @endif
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
                            @if(isset($licRbq))
                                @foreach($licRbq as $lic)
                                    <p>{{ $lic->TypeLicence }} {{ $lic->Statut }}</p>
                                @endforeach
                            @endif
                            
                            <div class="card">
                                <div class="card-header">
                                    Catégories et sous-catégories autorisées
                                </div>
                                <div class="card-body">
                                    @if ($licRbq->contains('Categorie', 'Général') || $licRbq->contains('Categorie', 'Generale'))
                                        <h3>CATÉGORIE ENTREPRENEUR GÉNÉRAL</h3>
                                    @endif
                                    @foreach ($licRbq as $lic)
                                        @if ($lic->Categorie == "Generale" || $lic->Categorie == "Général")
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
                        <h3>Liste des fichiers téléchargés</h3>

                        <!-- Afficher les fichiers -->
                        @if(session('success'))
                            <p style="color: green;">{{ session('success') }}</p>
                        @endif

                        @if(session('error'))
                            <p style="color: red;">{{ session('error') }}</p>
                        @endif

                            <ul>
                                @if ($brochure)
                                    @foreach ($brochure as $file)
                                    <div>
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank">{{ basename($file) }}</a>
                                    </div>
                                    @endforeach
                                @else 
                                <p>Aucun fichier disponible</p>
                                @endif
                            </ul>                        
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
                                <p>Devise: {{ $fournisseur->Devise }}</p>
                                <p>Mode de communication: {{ $fournisseur->Mode_Communication }}</p>
                            </div>
                        </div>
                    @endif
                    <a href="/export/{{ hash('sha1', $fournisseur->id) }}"><button type="button" class="mt-4">Exporter</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
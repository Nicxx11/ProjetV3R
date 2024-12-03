@extends('layouts.app')

@section('titre','Détails des fournisseurs')
@section('newCss', asset('css/detailsFournisseurs.css'))

@section('contenu')
    <br>
    <a href="{{ url()->previous() }}" class="mt-5 ms-5"><button type="button">Retour</button></a>
    <table border="1" class="mt-3">
        <thead>
            <tr>
                <th>Entreprise</th>
                <th>Coordonnées</th>
                <th>Contacts</th>
                <th>Contactés</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fournisseurs as $fournisseur)
                <tr>
                    <!-- Supplier Information -->
                    <td><strong>Entreprise:</strong>{{ $fournisseur->Entreprise }}
                        <br>
                        <strong>Courriel:</strong>{{$fournisseur->Courriel}}
                    </td>

                    <!-- Coordinates -->
                    <td>
                        @if($coordonnees->has($fournisseur->id))
                            @foreach($coordonnees[$fournisseur->id] as $coord)
                                <div>
                                    <strong>{{ $coord->TypeTelephone }}:</strong> {{ $coord->Numero }}
                                    @if($coord->Poste)
                                        (Poste {{ $coord->Poste }})
                                    @endif
                                    <br>
                                    <strong>Adresse:</strong> 
                                    {{ $coord->NoCivique }} {{ $coord->Rue }}, {{ $coord->Ville }}, {{ $coord->Province }} {{ $coord->CodePostal }}
                                </div>
                            @endforeach
                        @else
                            <em>Aucune coordonnée disponible</em>
                        @endif
                    </td>

                    <!-- Contacts -->
                    <td>
                    <div class="contact-container" data-contacts="{{ json_encode($contacts[$fournisseur->id]) }}">
                        <!-- Display the first contact -->
                        @php $firstContact = $contacts[$fournisseur->id]->first(); @endphp
                        <div class="contact-display">
                            <strong>{{ $firstContact->Prenom }} {{ $firstContact->Nom }}</strong>, {{ $firstContact->Fonction }}
                            <br>
                            <span class="contact-email">{{ $firstContact->Courriel }}</span>
                            <br>
                            {{ $firstContact->TypeTelephone }} {{ $firstContact->Numero }}
                            @if($firstContact->Poste)
                                (Poste {{ $firstContact->Poste }})
                            @endif
                        </div>

                        <!-- Navigation arrows -->
                        @if(count($contacts[$fournisseur->id]) > 1)
                            <button type="button" class="arrow left-arrow" disabled>&larr;</button>
                            <button type="button" class="arrow right-arrow">&rarr;</button>
                        @endif
                    </div>
                    </td>

                    <!-- Contacted Checkbox -->
                    <td>
                        <input type="checkbox" name="contacted[]" value="{{ $fournisseur->id }}" class="large-checkbox">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('scripts')
<script src="{{ asset('js/detailsFournisseurs.js') }}"></script>
@endsection
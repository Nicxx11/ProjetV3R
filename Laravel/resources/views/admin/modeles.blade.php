@extends('layouts.app')

@section('titre', 'Gestion des Paramètres Système')

@section('contenu')

<div class="container">
    <h2>Modifier un modèle de courriel</h2>
    <!-- Success Message after Update -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form for selecting and editing the model -->
    <form action="{{ old('modele_id', $selectedModele->id ?? null) ? route('modeles.update', ['id' => old('modele_id', $selectedModele->id)]) : '#' }}" method="POST">
        @csrf

        <!-- Dropdown for selecting a model -->
        <div class="form-group">
            <label for="modeleSelect">Choisir un modèle</label>
            <select id="modeleSelect" name="modele_id" class="form-control" required>
                <option value="">Sélectionner un modèle</option>
                @foreach($modeles as $modele)
                    <option value="{{ $modele->id }}" {{ old('modele_id', $selectedModele->id ?? '') == $modele->id ? 'selected' : '' }} name="id">
                        {{ $modele->NomModele }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Placeholder for the message input field -->
        <div id="messageModeleField">
            @if(isset($selectedModele))
                <div class="form-group mt-3">
                    <label for="messageModele">Message du modèle</label>
                    <textarea id="messageModele" name="message_modele" class="form-control" rows="10" required>{{ old('message_modele', $selectedModele->MessageModele) }}</textarea>
                </div>
            @else
                <div class="alert alert-warning mt-3">
                    Veuillez sélectionner un modèle pour modifier son message.
                </div>
            @endif
        </div>
        <a href="/Fournisseurs/Liste"><button type="button" style=" border-radius:5px;">Retour</button></a>
        <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
    </form>
</div>


@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modeleSelect = document.getElementById('modeleSelect');
        const messageModeleField = document.getElementById('messageModeleField'); // Div to hold the message field

        modeleSelect.addEventListener('change', function () {
            const selectedModeleId = modeleSelect.value;

            if (selectedModeleId) {
                // If a model is selected, make the message field visible and populate it
                fetch(`/modeles/${selectedModeleId}/message`)  // Example API endpoint to get the message
                    .then(response => response.json())
                    .then(data => {
                        console.log('IN YAY')
                        if (data.message) {
                            messageModeleField.innerHTML = `
                                <div class="form-group mt-3">
                                    <label for="messageModele">Message du modèle</label>
                                    <textarea id="messageModele" name="message_modele" class="form-control" rows="10" required>${data.message}</textarea>
                                </div>
                            `;
                        }
                    })
                    .catch(error => console.error('Error fetching message:', error));
            } else {
                // If no model is selected, hide the message field
                messageModeleField.innerHTML = '';
            }
        });
    });
</script>
@endsection
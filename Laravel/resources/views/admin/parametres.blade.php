@extends('layouts.app')
@section('titre', 'Gestion des Paramètres Système')
@section('contenu')
<div class="container">
    <h1>Modifier les Paramètres Systèmes</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('parametres_systemes.update') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="Approvisionnement">Approvisionnement (Email)</label>
            <input type="email" class="form-control" id="Approvisionnement" name="Approvisionnement" value="{{ old('Approvisionnement', $parametres->Approvisionnement) }}" required>
            @error('Approvisionnement')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="DelaiRevision">Délai de Révision (Mois)</label>
            <input type="number" class="form-control" id="DelaiRevision" name="DelaiRevision" value="{{ old('DelaiRevision', $parametres->DelaiRevision) }}" required>
            @error('DelaiRevision')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="TailleMaxBrochures">Taille Max des Brochures (Mo)</label>
            <input type="number" class="form-control" id="TailleMaxBrochures" name="TailleMaxBrochures" value="{{ old('TailleMaxBrochures', $parametres->TailleMaxBrochures) }}" required>
            @error('TailleMaxBrochures')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="Finances">Finances (Email)</label>
            <input type="email" class="form-control" id="Finances" name="Finances" value="{{ old('Finances', $parametres->Finances) }}" required>
            @error('Finances')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <a href="/Fournisseurs/Liste"><button type="button" style=" border-radius:5px;">Retour</button></a>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection

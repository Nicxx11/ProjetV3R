@extends('layouts.app')

@section('titre', 'Réinitialisation du mot de passe')
@section('newCss', 'css/app.css')

@section('contenu')
<form action="{{ route('password.reset') }}">
    <div>
        <label for="token">Entrez le code temporaire que vous avez reçu par courriel</label>
        <br>
        <input placeholder="Code" type="text" id="token" name="token">
    </div>
    <div>
        <label for="password">Entrez le nouveau mot de passe</label>
        <br>
        <input placeholder="Code" type="password" id="password" name="password">
        @error('MotDePasse')
            <p class="erreur">{{ $message }}</p>
        @enderror
    </div>
    <button>Soumettre</button>
</form>
@endsection
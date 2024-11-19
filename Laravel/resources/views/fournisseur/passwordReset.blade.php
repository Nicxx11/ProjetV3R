@extends('layouts.app')

@section('titre', 'Réinitialisation du mot de passe')

@section('contenu')
<h2>Demande de Réinitialisation de Mot de Passe</h2>
<p>Entrez votre adresse e-mail ci-dessous pour recevoir un lien de réinitialisation de mot de passe :</p>

<form action="{{ route('password.reset') }}" method="POST">
    @csrf
    <label for="Courriel">Adresse e-mail :</label>
    <input type="Courriel" id="Courriel" name="Courriel" required>
    <button type="submit">Envoyer le lien de réinitialisation</button>
</form>

@endsection
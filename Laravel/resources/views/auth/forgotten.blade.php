@extends('layouts.app')

@section('titre', 'Mot de passe oublié')

@section('contenu')
<h2>Demande de Réinitialisation de Mot de Passe</h2>
<p>Entrez votre adresse courriel ci-dessous pour recevoir un lien de réinitialisation de mot de passe :</p>

<form action="{{ route('token.send') }}" method="POST">
    @csrf
    <label for="Courriel">Adresse courriel :</label>
    <input type="email" id="Courriel" name="Courriel" required autofocus>
    <button type="submit">Envoyer le lien de réinitialisation</button>
    <a href="{{ url()->previous() }}" class="mt-5 ms-5"><button type="button">Retour</button></a>
</form>

@endsection
@extends('layouts.app')

@section('titre', 'Inscription')
@section('newCss', 'css/app.css')

@section('contenu')

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif
<div class="container-fluid vh-100 d-flex align-items-center justify-content-center overlay">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="card cardColors text-center">
            <form action="{{ route('inscription.store') }}" method="POST">
                @csrf
                <div class="form-header pb-4 pt-4">
                    <h1>Inscription</h1>
                </div>
                <div class="form-group">
                    <label for="NEQ">NEQ:</label></br>
                    <input placeholder="NEQ" type="text" id="NEQ" name="NEQ" value="{{ old('NEQ') }}">
                    @error('NEQ')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="Courriel">Courriel:</label></br>
                    <input placeholder="Adresse courriel de la compagnie" type="text" id="Courriel" name="Courriel"
                        value="{{ old('Courriel') }}">
                    @error('Courriel')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="Entreprise">Entreprise:</label></br>
                    <input placeholder="Nom complet de l'entreprise" type="text" id="Entreprise" name="Entreprise"
                        value="{{ old('Entreprise') }}">
                    @error('Entreprise')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="MotDePasse">Mot de Passe:</label><br>
                    <input placeholder="Mot de passe sécuritaire" type="password" id="MotDePasse" name="MotDePasse"
                        aria-describedby="exigences-motdepasse">
                    <div class="popup" id="exigences-motdepasse">
                        <div class="pointer"></div>
                        <ul>
                            <li>Au moins 8 caractères</li>
                            <li>Au moins 1 lettre majuscule</li>
                            <li>Au moins 1 lettre minuscule</li>
                            <li>Au moins 1 chiffre</li>
                            <li>Au moins 1 caractère spécial</li>
                        </ul>
                    </div>

                    @error('MotDePasse')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="MotDePasse">Confirmation Mot de Passe:</label></br>
                    <input placeholder="Confirmer votre Mot de passe" type="password" id="MotDePasse_confirmation" name="MotDePasse_confirmation">
                    @error('MotDePasse')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="Details">Détails:</label></br>
                    <textarea id="Details" name="Details">{{ old('Details') }}</textarea>
                    @error('Details')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <button class="mb-4" type="submit">S'inscrire</button>
                <a href="{{ route('index.index') }}"><button type="button">Retour</button></a>
            </form>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
<script src="{{ asset('js/inscription.js') }}" type="module"></script>
@endsection
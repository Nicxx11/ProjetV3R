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
    <div class="popup" id="exigences-motdepasse">
                        <div class="pointer"></div>   
                        <ol>                     
                            <li>Au moins 8 caractères</li>
                            <li>Au moins 1 lettre majuscule</li>
                            <li>Au moins 1 lettre minuscule</li>
                            <li>Au moins 1 chiffre</li>
                            <li>Au moins 1 caractère spécial</li>      
                        </ol>                 
                    </div>
        <div class="card cardColors" style="position:relative;">
            <div class="row">
            <div class="col-md-4">
                <!-- empty column -->
            </div>
            <div class="col-md-7 colInsc">
            <form action="{{ route('inscription.store') }}" method="POST">
                @csrf
                <div class="form-header pb-4 pt-4">
                    <h1 class="colInsc">Inscription</h1>
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
                    <input placeholder="Courriel de la compagnie" type="text" id="Courriel" name="Courriel"
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
                    <label for="MotDePasse">Mot de passe:</label><br>
                    <input placeholder="Mot de passe sécuritaire" type="password" id="MotDePasse" name="MotDePasse"
                        aria-describedby="exigences-motdepasse">
                    @error('MotDePasse')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="MotDePasse">Confirmation mot de passe:</label></br>
                    <input placeholder="Confirmer votre mot de passe" type="password" id="MotDePasse_confirmation" name="MotDePasse_confirmation">
                    @error('MotDePasse')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="Details">Détails:</label></br>
                    <textarea class="textDetail" rows="3" style="resize:none;" id="Details" name="Details">{{ old('Details') }}</textarea>
                    @error('Details')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <a href="{{ route('index.index') }}"><button class="marginRT px-2 py-1" type="button">Retour</button></a>
                <button class="mb-4 px-2 py-1" type="submit">Suivant</button>
            </form>

            </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
<script src="{{ asset('js/inscription.js') }}" type="module"></script>
@endsection
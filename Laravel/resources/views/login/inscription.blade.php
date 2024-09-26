@extends('layouts.app')

@section('titre', 'Inscription')
@section('newCss','css/app.css')

@section('contenu')

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif
<div class="container-fluid vh-100 d-flex align-items-center justify-content-center overlay">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class="card cardColors text-center">
            <form action="{{ route('inscription.store') }}" method="POST">
                @csrf
                <div class="form-header pb-4 pt-4">
                    <h1>Inscription</h1>
                </div>
                <div class="form-group">
                    <label for="NEQ">NEQ:</label></br>
                    <input type="text" id="NEQ" name="NEQ" value="{{ old('NEQ') }}">
                    @error('NEQ')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Courriel">Courriel:</label></br>
                    <input type="text" id="Courriel" name="Courriel" value="{{ old('Courriel') }}">
                    @error('Courriel')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Entreprise">Entreprise:</label></br>
                    <input type="text" id="Entreprise" name="Entreprise" value="{{ old('Entreprise') }}">
                    @error('Entreprise')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="MotDePasse">Mot de Passe:</label></br>
                    <input type="password" id="MotDePasse" name="MotDePasse">
                    @error('MotDePasse')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="MotDePasse">Confirmation Mot de Passe:</label></br>
                    <input type="password" id="MotDePasse_confirmation" name="MotDePasse_confirmation">
                    @error('MotDePasse')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Details">Détails:</label></br>
                    <textarea id="Details" name="Details">{{ old('Details') }}</textarea>
                    @error('Details')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit">S'inscrire</button>
            </form>
        </div>
    </div>
    <div class="col-md-3">
    </div>
</div>
@endsection
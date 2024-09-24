@extends('layouts.app')

@section('titre','Inscription')

@section('contenu')

<h1>Inscription</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('inscription.store') }}" method="POST">
        @csrf

        <label for="NEQ">NEQ:</label>
        <input type="text" id="NEQ" name="NEQ" value="{{ old('NEQ') }}">
        @error('NEQ')
            <p class="erreur">{{ $message }}</p>
        @enderror

        <label for="Courriel">Courriel:</label>
        <input type="text" id="Courriel" name="Courriel" value="{{ old('Courriel') }}">
        @error('Courriel')
            <p class="erreur">{{ $message }}</p>
        @enderror

        <label for="Entreprise">Entreprise:</label>
        <input type="text" id="Entreprise" name="Entreprise" value="{{ old('Entreprise') }}">
        @error('Entreprise')
            <p class="erreur">{{ $message }}</p>
        @enderror

        <label for="MotDePasse">Mot de Passe:</label>
        <input type="password" id="MotDePasse" name="MotDePasse">
        @error('MotDePasse')
            <p class="erreur">{{ $message }}</p>
        @enderror

        <label for="MotDePasse">Confirmation Mot de Passe:</label>
        <input type="password" id="MotDePasse_confirmation" name="MotDePasse_confirmation">
        @error('MotDePasse')
            <p class="erreur">{{ $message }}</p>
        @enderror

        <label for="Details">Détails:</label>
        <textarea id="Details" name="Details">{{ old('Details') }}</textarea>
        @error('Details')
            <p class="erreur">{{ $message }}</p>
        @enderror

        <button type="submit">S'inscrire</button>
    </form>
@endsection
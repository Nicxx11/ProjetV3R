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
        <input type="text" id="NEQ" name="NEQ" maxlength="10" pattern="\d{10}" value="{{ old('NEQ') }}">
        @error('NEQ')
            <p>{{ $message }}</p>
        @enderror

        <label for="Courriel">Courriel:</label>
        <input type="email" id="Courriel" name="Courriel" value="{{ old('Courriel') }}">
        @error('Courriel')
            <p>{{ $message }}</p>
        @enderror

        <label for="Entreprise">Entreprise:</label>
        <input type="text" id="Entreprise" name="Entreprise" maxlength="64" value="{{ old('Entreprise') }}">
        @error('Entreprise')
            <p>{{ $message }}</p>
        @enderror

        <label for="MotDePasse">Mot de Passe:</label>
        <input type="password" id="MotDePasse" name="MotDePasse" maxlength="12">
        @error('MotDePasse')
            <p>{{ $message }}</p>
        @enderror

        <label for="Details">Détails:</label>
        <textarea id="Details" name="Details" maxlength="500">{{ old('Details') }}</textarea>
        @error('Details')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">S'inscrire</button>
    </form>
@endsection
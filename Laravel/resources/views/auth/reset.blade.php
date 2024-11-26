@extends('layouts.app')

@section('titre', 'Réinitialisation du mot de passe')
@section('newCss', 'css/app.css')

@section('contenu')
<form action="{{ route('password.reset') }}" method="POST">
    @csrf
    <input type="hidden" name="token_h" id="token_h" value="{{$Token}}">

    <div>
        <label for="token">Entrez le code temporaire que vous avez reçu par courriel</label>
        <br>
        <input placeholder="Code" type="text" id="Token" name="Token">
        @error('Token')
            <p class="erreur" style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="MotDePasse">Entrez le nouveau mot de passe</label>
        <br>
        <input placeholder="Ex.: Abcd123$" type="password" id="MotDePasse" name="MotDePasse">
        @error('MotDePasse')
            <p class="erreur" style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="MotDePasse">Confirmation mot de passe:</label></br>
        <input placeholder="Confirmer votre mot de passe" type="password" id="MotDePasse_confirmation" name="MotDePasse_confirmation">
        @error('MotDePasse')
            <p class="erreur" >{{ $message }}</p>
        @enderror
    </div>
    
    <button>Soumettre</button>
</form>
@endsection
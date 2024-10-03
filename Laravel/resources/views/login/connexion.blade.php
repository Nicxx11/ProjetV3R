@extends('layouts.app')

@section('titre','Connexion')
@section('newCss', 'css/connexion.css')

@section('contenu')
<div class="container-fluid vh-100 d-flex align-items-center justify-content-center overlay">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="card cardColors" style="position:relative;">
            <div class="row">
            <div class="col-md-3">
                <!-- empty column -->
            </div>
            <div class="col-md-7">
            <form action="{{ route('fournisseurs.list') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="margCardT" for="id">Identifiant</label></br>
                    <input placeholder="  NEQ/Courriel" type="text" id="id" name="id" value="{{ old('id') }}">
                </div>
                <div class="form-group mt-5">
                    <label for="MotDePasse">Mot de Passe:</label><br>
                    <input placeholder="  Mot de passe" type="password" id="MotDePasse" name="MotDePasse">
                </div>
                <a href="{{ route('inscription.create') }}"><span style="color:#1294ff;">Soumettre une demande</span></a>
                <button class="mt-2 margCo margCardB px-2 py-1" type="submit">Connexion</button>
            </form>

            </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
@endsection
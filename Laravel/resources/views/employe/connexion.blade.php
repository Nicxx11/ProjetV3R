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
            <form action="{{ route('utilisateurs.login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="margCardT" for="id">Identifiant</label></br>
                    <input placeholder="  Courriel" type="text" id="Courriel" name="Courriel" value="{{ old('id') }}">
                    @error('Courriel')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-5">
                    <label for="MotDePasse">Mot de passe:</label><br>
                    <input placeholder="  Mot de passe" type="password" id="MotDePasse" name="MotDePasse">
                    @error('MotDePasse')
                        <p class="erreur">{{ $message }}</p>
                    @enderror
                    
                </div>
                <button class="mt-2 margCo px-2 py-1" type="submit">Connexion</button>
            </form>
            <a href="{{route('index.index')}}" ><p class="margCardB" style="color:#1294ff;">Fournisseurs</p></a>

            </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
@endsection
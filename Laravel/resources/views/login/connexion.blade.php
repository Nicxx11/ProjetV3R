@extends('layouts.app')

@section('titre','Connexion')

@section('contenu')
    <div class="container-fluid loginBG">
        <div class="row h-100">
            <div class="col-md-3">
                <!-- EMPTY ZONE -->
            </div>
            <div class="col-md-6 text-center align-self-center">
                <div class="card">

                    <h1>Connexion</h1>
                    <!----------------- ajout -------------------->
                    <h2>Liste des fournisseurs (test)</h2>
                    @if (count($fournisseurs))
                        @foreach($fournisseurs as $fournisseur)
                            <li>{{ $fournisseur->NEQ }}</li>
                            <li>{{ $fournisseur->Entreprise }}</li>
                            <li>{{ $fournisseur->Courriel }}</li>
                        @endforeach
                    @else
                        <p>Il n'y a pas de fournisseurs</p>
                    @endif

                    <a href="{{ route('inscription.create') }}"><button>Inscription</button></a>
                    <!-- <form action="/connexion" method="post" class="section">
                    {{ csrf_field() }}

        <div class="field">
            <label class="label">Adresse e-mail</label>
            <div class="control">
                <input class="input" type="email" name="email" value="{{ old('email') }}">
            </div>
            @if($errors->has('email'))
                <p class="help is-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div class="field">
            <label class="label">Mot de passe</label>
            <div class="control">
                <input class="input" type="password" name="password">
            </div>
            @if($errors->has('password'))
                <p class="help is-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-link" type="submit">Se connecter</button>
            </div>
        </div>
    </form> -->
                    <!----------------- ajout -------------------->
                </div>
            </div>
            <div class="col-md-3">
                <!-- EMPTY ZONE -->
            </div>
        </div>
        <div class="row">
            <!-- Créer Connexion NEQ / Email / MDP oublié (superficiellement)(card?) -->
        </div>
    </div>
@endsection
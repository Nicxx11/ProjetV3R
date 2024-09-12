<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css"> 

</head>
<body>
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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
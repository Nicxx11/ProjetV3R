@extends('layouts.app')

@section('titre','Liste des Utilisateurs')

@section('contenu')

<!-- Success or Error Messages -->
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@elseif(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<a href="{{ route('utilisateurs.showLogin') }}" class="mt-5 ms-5"><button type="button">Retour</button></a>

<!-- Form to update user roles -->
<form action="{{ route('utilisateurs.updateRoles') }}" method="POST">
    @csrf
    <table id="tableUtilisateurs">
        <tr>
            <th>Utilisateur</th>
            <th>Rôle</th>
            <th>Actions</th> <!-- Added column for actions -->
        </tr>
        @isset($utilisateurs)
            @foreach($utilisateurs as $user)
                <tr>
                    <td>{{$user->Courriel}}</td>
                    <td>
                        <select name="roles[{{ $user->id }}]">
                            <option @if($user->Role == 'Administrateur') selected @endif>Administrateur</option>
                            <option @if($user->Role == 'Responsable') selected @endif>Responsable</option>
                            <option @if($user->Role == 'Commis') selected @endif>Commis</option>
                        </select>
                    </td>
                    <td>
                        <a href="{{ route('utilisateurs.destroy', $user->id )}}"><button type="button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button></a>
                    </td>
                </tr>
            @endforeach
        @endisset
    </table>
    
    <button type="submit">Enregistrer</button>
</form>

<!-- Form to add a new user -->
<h2>Ajouter un Utilisateur</h2>
<form action="{{ route('utilisateurs.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="Prenom">Prénom</label>
        <input type="text" name="Prenom" id="Prenom" class="form-input" required>
        @error('Prenom')
            <p class="erreur">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="Nom">Nom</label>
        <input type="text" name="Nom" id="Nom" class="form-input" required>
        @error('Nom')
            <p class="erreur">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="Courriel">Courriel</label>
        <input type="email" name="Courriel" id="Courriel" class="form-input" required>
        @error('Courriel')
            <p class="erreur">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="Role">Rôle</label>
        <select name="Role" id="Role" class="form-input" required>
            <option value="Administrateur">Administrateur</option>
            <option value="Responsable">Responsable</option>
            <option value="Commis">Commis</option>
        </select>
        @error('Role')
            <p class="erreur">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="MotDePasse">Mot de Passe</label>
        <input type="password" name="MotDePasse" id="MotDePasse" class="form-input" required>
        @error('MotDePasse')
            <p class="erreur">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit">Ajouter</button>
</form>

@endsection

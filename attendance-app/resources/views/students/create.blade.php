@extends('layouts.layout')

@section('title', 'Création d'un étudiant')

@section('titre_page')
    <h2>Création d'un étudiant</h2>
@endsection

@section('content')
    <h2>Création :</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <!-- Matricule -->
        <div>
            <label for="matricule">Matricule :</label>
            <input type="number" id="matricule" name="matricule" required>
            @if ($errors->has('matricule'))
                <span class="text-danger">{{ $errors->first('matricule') }}</span>
            @endif
        </div>

        <!-- Prénom -->
        <div>
            <label for="firstname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" required>
            @if ($errors->has('firstname'))
                <span class="text-danger">{{ $errors->first('firstname') }}</span>
            @endif
        </div>

        <!-- Nom -->
        <div>
            <label for="lastname">Nom :</label>
            <input type="text" id="lastname" name="lastname" required>
            @if ($errors->has('lastname'))
                <span class="text-danger">{{ $errors->first('lastname') }}</span>
            @endif
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary">Ajouter Étudiant</button>
    </form>
@endsection
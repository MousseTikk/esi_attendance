@extends('layouts.layout')

@section('title', 'Liste des Étudiants')

@section('titre_page')
    <h2>Liste des Étudiants</h2>
@endsection

@section('content')   

    <h2>Liste des étudiants :</h2>
    
    <div style="margin-bottom: 20px;">
        <a href="{{ route('students.create') }}" class="btn btn-success" style="padding: 10px 20px; text-decoration: none;">
            <i class="fa fa-plus"></i> Ajouter un étudiant
        </a>
    </div>
    <table class="student-table">
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th></th> <!-- Nouvelle colonne pour les actions -->            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->matricule }}</td>
                    <td>{{ $student->firstname }}</td>
                    <td>{{ $student->lastname }}</td>
                    <td>
                        <!-- Formulaire pour supprimer l'étudiant -->
                        <form action="{{ route('students.destroy', $student->matricule) }}" method="POST" onsubmit="return confirmDeletion();" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <!-- Bouton rouge avec icône de corbeille -->
                            <button type="submit" class="btn btn-danger" style="background-color: red; border: none; padding: 5px 10px; border-radius: 5px;">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <script>
        // Fonction de confirmation de suppression
        function confirmDeletion() {
            return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');
        }
    </script>
@endsection

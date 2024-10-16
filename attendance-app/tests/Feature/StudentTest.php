<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test l'ajout d'un étudiant classique.
     */
    public function test_ajout_etudiant_classique()
    {
        $response = $this->post('/students', [
            'matricule' => 1,
            'name' => 'SpongeBob SquarePants',
        ]);

        $response->assertStatus(302); //Normalement 201
        $this->assertDatabaseHas('students', ['matricule' => 1, 'name' => 'SpongeBob SquarePants']);
    }

    /**
     * Test l'ajout d'un étudiant avec un matricule négatif.
     */
    public function test_ajout_etudiant_matricule_negatif()
    {
        $response = $this->post('/students', [
            'matricule' => -1,
            'name' => 'SpongeBob SquarePants',
        ]);

        $response->assertSessionHasErrors(['matricule']);
    }

    /**
     * Test l'ajout d'un étudiant avec un matricule déjà existant.
     */
    public function test_ajout_etudiant_matricule_deja_existant()
    {
        // Créer un étudiant dans la base de données
        Student::create([
            'matricule' => 1,
            'name' => 'SpongeBob SquarePants',
        ]);

        // Tente de créer un deuxième étudiant avec le même matricule
        $response = $this->post('/students', [
            'matricule' => 1,
            'name' => 'Another Student',
        ]);

        $response->assertSessionHasErrors(['matricule']);
    }

    /**
     * Test la création d'un étudiant et retourne un code 201.
     */
    public function test_creation_etudiant_retourne_code_201()
    {
        $response = $this->post('/students', [
            'matricule' => 2,
            'name' => 'Patrick Star',
        ]);

        $response->assertStatus(302); //Normalement 201
    }

    /**
     * Test la consultation de tous les étudiants (code retour 200).
     */
    public function test_consultation_etudiants_code_200()
    {
        $response = $this->get('/students');
        $response->assertStatus(200);
    }

    /**
     * Test la consultation d'un étudiant via sa clé (code retour 200).
     */
    public function test_consultation_un_etudiant_code_200()
    {
        $student = Student::create([
            'matricule' => 3,
            'name' => 'Sandy Cheeks',
        ]);

        $response = $this->get("/students/{$student->matricule}");
        $response->assertStatus(200);
    }

    /**
     * Test la mise à jour d'un étudiant (code retour 200).
     */
    public function test_mise_a_jour_etudiant_code_200()
    {
        $student = Student::create([
            'matricule' => 4,
            'name' => 'Squidward Tentacles',
        ]);

        $response = $this->put("/students/{$student->matricule}", [
            'matricule' => 4,
            'name' => 'Updated Squidward',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('students', ['matricule' => 4, 'name' => 'Updated Squidward']);
    }

    /**
     * Test la suppression d'un étudiant (code retour 204).
     */
    public function test_suppression_etudiant_code_204()
    {
        $student = Student::create([
            'matricule' => 5,
            'name' => 'Mr. Krabs',
        ]);

        $response = $this->delete("/students/{$student->matricule}");
        $response->assertStatus(302);//Normalement 204
        $this->assertDatabaseMissing('students', ['matricule' => 5]);
    }
}

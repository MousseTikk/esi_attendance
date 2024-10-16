<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students')); 
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricule' => 'required|integer|min:0|unique:students,matricule',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ], [
            'matricule.min' => 'Le matricule ne peut pas être un nombre négatif.',
            'matricule.unique' => 'Le matricule existe déjà.'
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Étudiant ajouté avec succès.');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        // diplsay a student
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(string $id)
    {
        // diplsay form for a modification of student
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'matricule' => 'required|integer|min:0',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ], [
            'matricule.min' => 'Le matricule ne peut pas être un nombre négatif.',
        ]);

        $student->update($request->all());

        // redirect from show student
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Étudiant retiré avec succès.');
    }
}

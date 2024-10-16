<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::truncate();
        $csvData = fopen(base_path('database/csv/etudiants_bruxelles_100.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                Student::create([
                    'matricule' => $data['2'],
                    'firstname' => $data['0'],
                    'lastname' => $data['1'],
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}

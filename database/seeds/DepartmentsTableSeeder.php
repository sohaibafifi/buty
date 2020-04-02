<?php

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::firstOrCreate([
            'name' => 'Réseaux et Télécoms',
            'scodoc_url' => 'https://scoliut.univ-artois.fr/ScoDoc/',
            'scodocId' => 'RT',
            'scodoc_user' => 'notes-api',
            'scodoc_password' => env('RT_SCODOC_PASSWORD', ''),
        ]);
    }
}

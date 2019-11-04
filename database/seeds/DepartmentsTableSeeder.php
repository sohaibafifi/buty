<?php

use App\Department;
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
            'scodocId' => 'RT',
            'scodoc_user' => 'notes-api',
            'scodoc_password' => 'progtr11'
        ]);
    }
}

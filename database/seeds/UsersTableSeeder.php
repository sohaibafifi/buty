<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'sohaib.lafifi@univ-artois.fr')->exists()) {
            User::create([
                'username' => 'sohaib.lafifi',
                'email'    => 'sohaib.lafifi@univ-artois.fr',
                'password' => Hash::make('password'),
                'firstname' => 'Sohaib',
                'lastname' => 'LAFIFI',
                'role'     => 'teacher'
            ]);
        }
    }
}

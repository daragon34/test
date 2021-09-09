<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Dílinger Aragón Perea',
            'email'=>'daragon34@misena.edu.co',
            'password'=>bcrypt('12345678'),
            'rol'=>0
        ]);

        User::create([
            'name'=>'Sara Sofía Aragón',
            'email'=>'sarasofia@correo.com',
            'password'=>bcrypt('12345678'),
            'rol'=>1
        ]);
        
        User::create([
            'name'=>'Pedro Pérez',
            'email'=>'pperez@correo.com',
            'password'=>bcrypt('12345678'),
            'rol'=>1
        ]);

        User::create([
            'name'=>'Camila Carmona Quintero',
            'email'=>'camila@correo.com',
            'password'=>bcrypt('12345678'),
            'rol'=>2
        ]);
    }
}

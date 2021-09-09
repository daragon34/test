<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create([
            'nombre'=>'Crear un SI web',
            'descripcion'=>'El cliente requiere la creación de una plataforma web.',
            'project_id'=>1,
        ]);
        Category::create([
            'nombre'=>'Soporte',
            'descripcion'=>'Es necesario contactar al cliente para agendar una cita en la empresa',
            'project_id'=>2,
        ]);
    }
}

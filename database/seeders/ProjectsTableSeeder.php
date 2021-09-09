<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Project::create([
            'nombre'=>'Requerimiento de S.I.',
            'descripcion'=>'Proyecto para la puesta en marcha de un Sistema de Información para una tienda online',
        ]);

        Project::create([
            'nombre'=>'Requerimiento de Soporte en Sitio',
            'descripcion'=>'El cliente no puede crear productos desde el pánel de administración',
        ]);
    }
}

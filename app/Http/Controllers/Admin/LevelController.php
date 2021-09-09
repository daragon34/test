<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function store(Request $request){
        $this->validate($request, ['nombre' => 'required'],
        ['nombre.required'=>'El campo no debe quedar vacío']);
        
        Level::create($request->all());
        
        return back(); 
    }

    public function update(Request $request){
        $this->validate($request, 
            ['nombre' => 'required'],
            ['nombre.required'=>'El nombre de la categoría no debe quedar vacío']
        );
        $level_id = $request->input('level_id');
        $level = Level::find($level_id);
        $level->nombre = $request->input('nombre');
        $level->save();

        return back();
    }

    public function delete($id){
        Level::find($id)->delete();
        return back();
    }

    public function nProyecto($id){
        return Level::where('project_id', $id)->get();
    }
}

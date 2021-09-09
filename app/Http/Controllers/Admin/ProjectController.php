<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    //
    public function index(){
        $projects = Project::withTrashed()->get();

        return view ('admin.projects.index')->with(compact('projects'));
    }

    public function store(Request $request){
        
        $this->validate($request, Project::$validar, Project::$mensaje);
        
        Project::create($request->all());

        return back()->with('aviso', 'El proyecto ha sido creado');
    }

    public function edit($id){

        $project = Project::find($id);

        $categories = $project->categories;
        $levels= $project->levels;

        return view ('admin.projects.edit')->with(compact('project', 'categories', 'levels'));
    }

    public function update($id, Request $request){
        $this->validate($request, Project::$validar, Project::$mensaje);
        Project::find($id)->update($request->all());
        return back()->with('aviso', 'El proyecto ha sido actualizado');
    }

    public function delete($id){
        
        Project::find($id)->delete();
        return back()->with('aviso', 'El proyecto ha sido eliminado');
    }

    public function activate($id){
        
        Project::withTrashed()->find($id)->restore();
        return back()->with('aviso', 'El proyecto ha sido habilitado');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Incident;
use App\Models\Project;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        //forma 1:         $projects = Project::withTrashed()->get();

        $categories = Category::withTrashed()->get();

        /* $categories = Category::where('project_id',2)->get();*/
        return view('incidents.report')->with(compact('categories'));

       /*  //forma 2:
        $categories = Category::where('project_id',1)->get();
        return view('report')->with('categories', $categories); */
    }
    
    public function store(Request $request)
    {
        $validar = [
            'category_id'=>'sometimes|exists:categories,id',
            'severity'=>'required|in:B,N,A',
            'title'=>'required|min:5',
            'description'=>'required|min:15',
        ];
        $mensaje=[
            'category_id.exists'=>'La categoría no exixte.',
            'title.required'=>'Debe escribir un título para la incidencia.',
            'severity.required'=>'Debe elegir una severity para la incidencia.',
            'severity.in'=>'La severidad no existe.',
            'title.min'=>'El título debe tener al menos 5 caracteres.',
            'description.required'=>'Debe escribir una descripción para la incidencia.',
            'description.min'=>'La descripción debe tener al menos 15 caracteres.'
        ];

        $this->validate($request, $validar, $mensaje);
        
        //return $request->all();
        //dd($request->all());
        $incident = new Incident();
        $incident->category_id = $request->input('category_id');
        $incident->prioridad = $request->input('severity');
        $incident->titulo = $request->input('title');
        $incident->descripcion = $request->input('description');

        $user = auth()->user();

        $incident->client_id = $user->id;
        $incident->project_id = $user->selected_project_id;
        $incident->level_id = Project::find($user->selected_project_id)->first_level_id;
        $incident->save();

        //dd($incident->level_id);

        return back();
    }

    public function show($id){

        $incident = Incident::findorFail($id);
        return view('incidents.show')->with(compact('incident'));
    }

}

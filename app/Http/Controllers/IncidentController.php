<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Incident;
use App\Models\ProjectUser;
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

    public function heed($id){

        //Debemos validar que el usuario esté autenticado, pertenezca al proyecto y la incidencia y al nivel.
        $user = auth()->user();
        if (! $user->is_support)
            return back();

        $incident = Incident::findorFail($id);

        $project_user = ProjectUser::where('project_id', $incident->project_id)->where('user_id',$user->id)->first();

        if(! $project_user)
            return back();
        
        if ($project_user->level_id != $incident->level_id)
            return back();

        $incident->support_id = $user->id;
        $incident->save();

        return back();
        
    }

    public function end($id){

        $incident = Incident::findorFail($id);
        if ($incident->client_id != auth()->user()->id)
            return back();

        $incident->active = 0;
        $incident->save();

        return back();

    }

    public function open($id){
       
        $incident = Incident::findorFail($id);
        if ($incident->client_id != auth()->user()->id)
            return back();

        $incident->active = 1;
        $incident->save();

        return back();
    }

    public function nextLevel($id){
        $incident = Incident::findorFail($id);
        $level_id = $incident->level_id;

        $project = $incident->project;
        $levels = $project->levels;
        //dd($levels);
        $next_level_id = $this->getNextLevelId($level_id, $levels);
        
        if ($next_level_id){
            $incident->level_id = $next_level_id;
            $incident->save();
            return back();
        }

        return back()->with('aviso', 'No hay un siguiente nivel para la incidencia.');
        
    }

    public function getNextLevelId($level_id, $levels){
        //dd(sizeof($levels));

        if (sizeof($levels)<=1)
            return null;
        
        $position = -1;
        for ($i=0; $i<sizeof($levels)-1; $i++){
            if ($levels[$i]->id == $level_id){
                $position = $i;
                break;
            }
        }
        if ($position == -1)
            return null;

        //dd($levels[$i+1]);

        return $levels[$position+1]->id;
    }

    
    public function edit($id){
        $incident = Incident::findorFail($id);

    }
}

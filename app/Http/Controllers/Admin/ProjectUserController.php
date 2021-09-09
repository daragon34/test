<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    //Se podría validar que exista el proyecto, usuario 
    //y nivel y que además el nivel pertenezca al proyecto
    public function store(Request $request){

        $project_id =  $request->input('project_id');
        $user_id = $request->input('user_id');
        
        $project_user = ProjectUser::where('project_id',$project_id)->where('user_id', $user_id)->first();

        if($project_user)
            return back()->with('aviso','El proyecto ya ha sido asignado a este usuario');

        $project_user = new ProjectUser();
        $project_user->project_id = $project_id;
        $project_user->user_id = $user_id;
        $project_user->level_id = $request->input('level_id');
        $project_user->save();

        return back();
    }

    public function delete($id){
        ProjectUser::find($id)->delete();
        return back()->with('aviso','Se ha quitado la asignación al usuario');
    }
}

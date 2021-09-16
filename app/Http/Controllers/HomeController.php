<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\ProjectUser;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $selected_project_id = $user->selected_project_id;
        $incidentes = 0;
        $sin_asignar = 0;
        if ($user->is_support || $user->is_admin){
            $incidentes = Incident::where('project_id', $selected_project_id)
                                ->where('support_id', $user->id)->get();

            $projectUser = ProjectUser::where('project_id', $selected_project_id)
                                    ->where('user_id', $user->id)->first(); // Esta es la relación necesaria para la siguiente consulta

            //dd($projectUser->level_id);
            $sin_asignar = Incident::where('support_id', null)
                            ->where('level_id', $projectUser->level_id)->get(); 

        }
        
        
       $otros_incidentes = Incident::where('client_id', $user->id)
                            ->where('project_id', $selected_project_id)->get();
                        
        return view('home')->with(compact('incidentes', 'sin_asignar','otros_incidentes'));
    }
    
    public function seleccionarProyecto($id){
        
        $user = auth()->user();
        $user->selected_project_id = $id;
        $user->save();

        return back();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function project(){
        return $this->belongsTo('App\Models\Project');
    }

    public function level(){
        return $this->belongsTo('App\Models\Level');
    }

    public function support(){
        return $this->belongsTo('App\Models\User', 'support_id');
    }

    public function client(){
        return $this->belongsTo('App\Models\User', 'client_id');
    }



    public function getSupportNameAttribute(){
        
        if ($this->support)
            return $this->support->name;
        return 'No asignado';
    }

    public function getEstadoNameAttribute(){
        
        if ($this->active == 0)
            return 'Finalizado';
        
        if ($this->support_id)
            return 'Asignado';
            
        return 'Por asignar';
    }


    public function getPrioridadCompletoAttribute(){
        
        switch ($this->prioridad){
            case 'B': 
                return 'Baja';
            case 'N': return 'Normal';
            default:  return 'Alta';
        }
    }
}

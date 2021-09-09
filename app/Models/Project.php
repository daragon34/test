<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use SoftDeletes;
    
    public static $validar = [
        'nombre'=>'required',
        'descripcion'=>'required|min:10',
        'inicio'=>'date'
    ];
    public static $mensaje=[
        'nombre'=>'Debe escribir un nombre para el proyecto',
        'descripcion.required'=>'Debe escribir una descripción para el proyecto.',
        'descripcion.min'=>'La descripción debe tener al menos 10 caracteres.',
        'inicio.date'=>'Seleccione una fecha para el proyecto en el campo.'
    ];
    protected $fillable = [
        'nombre',
        'descripcion',
        'inicio',
    ];

    public function categories(){
        return $this->hasMany('App\Models\Category');
    }

    public function levels(){
        return $this->hasMany('App\Models\Level');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    public function getFirstLevelIdAttribute(){
        return $this->levels->first()->id;
    }
}

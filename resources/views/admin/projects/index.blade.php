@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <center><h5>Crear proyecto</h5></center>
    </div>
    <div class="panel-body">
        @if (session('aviso'))
            <div class="alert alert-success">
                {{session('aviso')}}
            </div>
        @endif
        @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="" method="POST">
        {{csrf_field()}}
            <div class="form-group">
                <label for="nombre">Título</label>
                <input type="nombre" name="nombre" class="form-control" value="{{old('nombre')}}"> 
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" class="form-control" value="{{old('descripcion')}}">
            </div>
            <div class="form-group">
                <label for="inicio">Fecha de inicio</label>
                <input type="date" name="inicio" class="form-control" value="{{old('inicio',date('Y-m-d'))}}">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Crear</button>
            </div>
        </form>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Inicio</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{$project->nombre}}</td>
                        <td>{{$project->descripcion}}</td>
                        <td>{{$project->inicio ?: 'No hay fecha de inicio'}}</td>
                        <td>
                            @if($project->trashed())
                                <a href="/proyecto/{{$project->id}}/activar" class="btn btn-sm btn-dark" title="Activar">Activar</a> 
                            @else
                                <a href="/proyecto/{{$project->id}}" class="btn btn-sm btn-light" title="Editar">Editar</a>                   
                                <a href="/proyecto/{{$project->id}}/eliminar" class="btn btn-sm btn-info" title="Eliminar">Eliminar</a>                    
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
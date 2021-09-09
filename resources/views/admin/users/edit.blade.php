@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <center><h5>Registrar usuario</h5></center>
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
        @endif
        <form action="" method="POST">
        {{csrf_field()}}
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" readonly value="{{isset($user->email)?$user->email:old('email')}}"> 
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{isset($user->name)?$user->name:old('name')}}">
            </div>
            <div class="form-group">
                <label for="description">Contraseña</label>
                <input type="text" name="password" class="form-control" placeholder="¿Desea cambiar la contraseña del usuario?">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Enviar</button>
            </div>
        </form>
        <form action="/proyecto-usuario" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <div class="row">
            <div class="col-md-5">
                <select name="project_id" class="form-control" id="select-project">
                    <option value="">Seleccionar proyecto</option>
                    @foreach($projects as $project)
                        <option value="{{$project->id}}">{{$project->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <select name="level_id" class="form-control" id="select-level">
                    <option value="">Seleccionar nivel</option>
                </select>
            </div><br>
            <div class="col-md-2">
                    <button class="btn btn-success">Asignar</button>
            </div>
        </div>
    </form><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Nivel</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects_user as $project_user)                                    
                    <tr>
                        <td>{{$project_user->project->nombre}}</td>
                        <td>{{$project_user->level->nombre}}</td>
                        <td>
                            {{--  <a href="" class="btn btn-warning" title="Editar">Realizar cambio<span class="glyphicon glyphicon-pencil"</span></a>                      --}}
                            <a href="/proyecto-usuario/{{$project_user->id}}/eliminar" class="btn btn-danger" title="Eliminar">Eliminar<span class="glyphicon glyphicon-remove"</span></a>                    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('ventana')
    <script src="\js\users\edit.js"></script>
@endsection

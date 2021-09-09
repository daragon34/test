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
            </div>
        @endif
        <form action="" method="POST">
        {{csrf_field()}}
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{old('email')}}"> 
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}">
            </div>
            <div class="form-group">
                <label for="description">Contraseña</label>
                <input type="text" name="password" class="form-control" value="{{old('password', Str::random(10))}}">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Enviar</button>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Creado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->rol}}</td>
                        <td>{{$user->created_at->format('Y-m-d')}}</td>
                        <td>
                            @if($user->trashed())
                                <a href="/usuario/{{$user->id}}/activar" class="btn btn-sm btn-dark" title="Activar">Activar</a> 
                            @else
                                <a href="/usuario/{{$user->id}}" class="btn btn-sm btn-light" title="Editar">Editar</a>                   
                                <a href="/usuario/{{$user->id}}/eliminar" class="btn btn-sm btn-info" title="Eliminar">Eliminar</a>                    
                            @endif                   
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
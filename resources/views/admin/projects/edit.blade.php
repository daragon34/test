@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <center><h5>Ver y editar información del proyecto: <span style="color:blue">{{$project->nombre}}</span></h5></center>
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
                <label for="nombre">Título</label>
                <input type="text" name="nombre" class="form-control" value="{{old('nombre', $project->nombre)}}"> 
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" class="form-control" value="{{old('descripcion', $project->descripcion)}}">
            </div>
            <div class="form-group">
                <label for="inicio">Fecha de inicio</label>
                <input type="date" name="inicio" class="form-control" value="{{old('inicio', $project->inicio)}}">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </form>
        <div class="row">
            <div class="col-md-6">
                <h5>Categorías</h5>
                <form action="/categorias" method="POST" class="form-inline">
                {{csrf_field()}}
                <input type="hidden" name="project_id" value="{{$project->id}}">
                    <div class="form-group">
                        <input type="text" name="nombre" class="form-control" placeholder="Escriba el nombre de la categoría">
                    </div><br>
                    <div class="form-group">
                        <input type="text" name="descripcion" class="form-control" placeholder="Agregue una descripción de la categoría">
                    </div><br>
                    <button class="btn btn-primary">Crear</button><br><br><br>
                </form>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Descripcion</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->nombre}}</td>
                                    <td>{{$category->descripcion}}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" title="Editar" data-category="{{$category->id}}">Editar</button> {{-- Importante el data-category para el modal --}}                   
                                        <a href="/categoria/{{$category->id}}/eliminar" class="btn btn-sm btn-danger" title="Eliminar">Eliminar</a>                   
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="col-md-6">
                <h5>Niveles</h5>
                <form action="/niveles" method="POST" class="form-inline">
                {{csrf_field()}}
                <input type="hidden" name="project_id" value="{{$project->id}}">
                    <div class="form-group">
                        <input type="text" name="nombre" class="form-control" placeholder="Escriba el nombre del nivel">
                    </div><br>
                    <button class="btn btn-primary">Crear</button><br><br><br>
                </form>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nivel</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($levels as $key=>$level)
                                <tr>
                                    <td>100{{$key+1}}</td>
                                    <td>{{$level->nombre}}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" title="Editar" data-level="{{$level->id}}">Editar</button>                    
                                        <a href="/nivel/{{$level->id}}/eliminar" class="btn btn-sm btn-danger" title="Eliminar">Eliminar</a>                  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="editarCategoria">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Editar categoría</h5>        
      </div>
      <form action="/categoria/editar" method="POST">
        {{csrf_field()}}
        <div class="modal-body">
            <input type="hidden" name="category_id"  id="category_id" value="">
            <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="category_nombre" value="">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion" class="form-control" id="category_descripcion" value=""></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="editarNivel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Editar nivel</h5>        
      </div>
      <form action="/nivel/editar" method="POST">
        {{csrf_field()}}
        <div class="modal-body">
            <input type="hidden" name="level_id"  id="level_id" value="">
            <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="level_nombre" value="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('ventana')
    <script src="/js/admin/projects/edit.js"></script>
@endsection
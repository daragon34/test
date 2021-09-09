@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <center><h5>Registrar incidencia</h5></center>
    </div>
    <div class="panel-body">
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
                <label for="category_id">Categoría</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="severity">Prioridad</label>
                <select name="severity" class="form-control">
                    <option value="B">Baja</option>
                    <option value="N">Normal</option>
                    <option value="A">Alta</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" class="form-control" value="{{old('title')}}">
            </div>
            <div class="form-group">
                <label for="title">Descripción</label>
                <textarea name="description" class="form-control">{{old('description')}}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Crear incidencia</button>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <center><h5>Ver detalles de incidencia</h5></center>
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
        <table class="table table-condensed">
            <tbody>
                <tr>
                    <th scope="row">Título</td>
                    <td>{{$incident->titulo}}</td>
                </tr>
                <tr>
                    <th scope="row">Descripción</td>
                    <td>{{$incident->descripcion}}</td>
                </tr>
                <tr>
                    <th scope="row">Documentos de soporte</td>
                    <td>No se han agregado.</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Proyecto</th>
                    <th>Categoría</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row" id="incident_id">{{$incident->id}}</td>
                    <td scope="row" id="incident_project">{{$incident->project->nombre}}</td>
                    <td scope="row" id="incident_category">{{$incident->category->nombre}}</td>
                    <td scope="row" id="incident_created_at">{{$incident->created_at}}</td>
                </tr>
                </tbody>
                <thead>
                <tr>
                    <th>Responsable</th>
                    <th>Visibilidad</th>
                    <th>Estado</th>
                    <th>Prioridad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row" id="incident_support">{{$incident->support_name}}</td>
                    <td scope="row" id="incident_visible">Público</td>
                    <td scope="row" id="incident_state">{{$incident->estado}}</td>
                    <td scope="row" id="incident_severity">{{$incident->prioridad}}</td>
                </tr>
                </tbody>
        </table>
        <button class="btn btn-primary" href="#" role="button">Atender</button>
    </div>
</div>
@endsection
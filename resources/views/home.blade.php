@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Dashboard</div>
    <div class="panel-body">
        @if(auth()->user()->is_support || auth()->user()->is_admin)
            <div class="panel panel-secondary">
                <div class="panel-heading">
                    <center class="panel-title">Mis incidencias</center>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Código</th>
                                <th>Categoría</th>
                                <th>Prioridad</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Resumen</th>
                            </tr>
                        </thead>
                        <tbody id="mis_incidentes">
                            @foreach($incidentes as $incident)
                                <tr>
                                    <td><a href="/ver/{{ $incident->id}}"> {{ $incident->id}}</a></td>
                                    <td>{{$incident->category->nombre}}</td>
                                    <td>{{$incident->prioridad_completo}}</td>
                                    <td>{{$incident->estado}}</td>
                                    <td>{{$incident->created_at}}</td>
                                    <td>{{$incident->descripcion}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-secondary">
                <div class="panel-heading">
                    <center class="panel-title">Incidencias no asignadas</center>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Código</th>
                                <th>Categoría</th>
                                <th>Prioridad</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Resumen</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="no_asignadas">
                            @foreach($sin_asignar as $incident)
                                <tr>
                                    <td><a href="/ver/{{ $incident->id}}"> {{ $incident->id}}</a></td>
                                    <td>{{$incident->category->nombre}}</td>
                                    <td>{{$incident->prioridad_completo}}</td>
                                    <td>{{$incident->estado}}</td>
                                    <td>{{$incident->created_at}}</td>
                                    <td>{{$incident->descripcion}}</td>
                                    <td>
                                        <a href="" class="btn btn-success">Atender</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
            <div class="panel panel-secondary">
                <div class="panel-heading">
                    <center class="panel-title">Historial de incidencias reportadas por mí:</center>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Código</th>
                                <th>Categoría</th>
                                <th>Prioridad</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Resumen</th>
                                <th>Responsable</th>
                            </tr>
                        </thead>
                        <tbody id="otras_incidencias">
                            @foreach($otros_incidentes as $incidents)
                                <tr>
                                    <td><a href="/ver/{{ $incidents->id}}"> {{ $incidents->id}}</a></td>
                                    <td>{{$incidents->category->nombre}}</td>
                                    <td>{{$incidents->prioridad_completo}}</td>
                                    <td>{{$incidents->estado}}</td>
                                    <td>{{$incidents->created_at}}</td>
                                    <td>{{$incidents->descripcion}}</td>
                                    <td>{{$incidents->support_id ?: 'Sin asignar'}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
@endsection
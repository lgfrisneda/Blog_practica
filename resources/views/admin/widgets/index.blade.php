@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de widgets
                    <a href="{{ route('widgets.create') }}" class="btn btn-sm btn-primary pull-right">Crear</a>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Nombre</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($widgets as $widget)
                            <tr>
                                <td>{{ $widget->id }}</td>
                                <td>{{ $widget->name}}</td>
                                <td width="10px">
                                    <a href="{{ route('widgets.show', $widget->id) }}" class="btn btn-sm btn-default">
                                        Ver
                                    </a>
                                </td>
                                <td width="10px">
                                    <a href="{{ route('widgets.edit', $widget->id) }}" class="btn btn-sm btn-default">
                                        Modificar
                                    </a>
                                </td>
                                <td width="10px">
                                    {!! Form::open(['route' => ['widgets.destroy', $widget->id], 'method' => 'DELETE']) !!}
                                    <button class="btn btn-sm btn-danger">
                                        Borrar
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
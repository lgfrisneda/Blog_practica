@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Modificar Widget
                </div>
                <div class="panel-body">
                    {!! Form::model( $widget, ['route' => ['widgets.update', $widget->id], 'method' => 'PUT']) !!}
                    
                    @include('admin.widgets.partials.form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
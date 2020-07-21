@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ver Widget {{ $widget->name}}
                </div>
                <div class="panel-body">
                    <div class="col-md-4 col-md-offset-4">
                        {!! $widget->code !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
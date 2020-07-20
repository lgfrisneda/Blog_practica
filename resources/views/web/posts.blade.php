@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-9">
        <h1>Lista de articulos</h1>
        <h4>{{ $subtitle }}</h4>
        @foreach ($posts as $post)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ $post->name}}
            </div>
            <div class="panel-body">
                @if($post->file)
                <img src="{{ $post->file }}" class="img-responsive">
                @endif
                {{ $post->excerpt }}
                <a href="{{ route('post', $post->slug) }}" class="pull-right">Leer más</a>
            </div>
        </div>
        @endforeach
        {{ $posts->render()}}
    </div>
    @include('web.widgets')
</div>
@endsection
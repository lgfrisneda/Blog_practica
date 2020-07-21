    <div class="col-md-3" style="text-align: -webkit-center;">
        <h1>Widgets</h1>
        @foreach ($widgets as $widget)
        <div class="panel panel-default">
            {!! $widget->code !!}
        </div>
        @endforeach
    </div>
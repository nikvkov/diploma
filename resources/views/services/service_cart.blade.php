{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{$service->title}}</h1>
            <img src="/uploads/services/large/{{$service->image}}" />
            <div class="content">
                {!!$service->content!!}
            </div>

            {{--<div class="row">--}}
                {{--@foreach($project->services as $service)--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-4">--}}
                            {{--<img width="50%" src="/uploads/services/medium/{{$service->image}}" alt="{{$service->alt}}" title="{{$service->title}}"/>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-8">--}}
                            {{--<h1>{{$service->title}}</h1>--}}
                            {{--<p>{{$service->short_text}}</p>--}}
                            {{--<a class="btn btn-info" href="/projects/{{$project->slug}}/{{$service->slug}}">Read more</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        </div>
    </div>
@stop
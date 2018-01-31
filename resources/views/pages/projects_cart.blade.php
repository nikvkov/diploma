{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

@section('content')
    <div class = "row">
        <div class = "col-md-12">
            <div class="btn-group btn-breadcrumb">
                <a class="btn btn-default" href="/" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a class="btn btn-default" href="/projects/" >Проекты</a>
                <a class="btn btn-default" href="/projects/{{$project->slug}}" >Проект</a>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>{{$project->title}}</h1>
            <img src="/uploads/project/large/{{$project->image}}" />
            <div class="content">
                {!!$project->content!!}
            </div>

            <div class="row">
                @foreach($project->services as $service)
                    <div class="row">
                    <div class="col-md-4">
                      <img width="50%" src="/uploads/services/medium/{{$service->image}}" alt="{{$service->alt}}" title="{{$service->title}}"/>
                    </div>
                    <div class="col-md-8">
                        <h1>{{$service->title}}</h1>
                        <p>{{$service->short_text}}</p>
                        <a class="btn btn-info" href="/projects/{{$project->slug}}/{{$service->slug}}">Read more</a>
                    </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
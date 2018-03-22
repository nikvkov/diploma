{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

@section('content')
    <div class = "row">
        <div class = "col-md-12">
            <div class="btn-group btn-breadcrumb">
                <a class="btn btn-default" href="/" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a class="btn btn-default" href="/projects/" >Проекты</a>
                <a class="btn btn-default active" href="/projects/{{$project->slug}}" >{{$project->title}}</a>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>{{$project->title}}</h1>
            <img style="float: left; margin: 10px; width: 20%" src="/uploads/project/large/{{$project->image}}" />
            <div class="content">
                {!!$project->content!!}
            </div>

            <div class="row">
                @foreach($project->services as $service)
                    @if($service->active !=0)

                    {{--<div class="col-md-4">--}}
                      {{--<img width="50%" src="/uploads/services/medium/{{$service->image}}" alt="{{$service->alt}}" title="{{$service->title}}"/>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8">--}}
                        {{--<h1>{{$service->title}}</h1>--}}
                        {{--<p>{{$service->short_text}}</p>--}}
                        {{--<a class="btn btn-info" href="/projects/{{$project->slug}}/{{$service->slug}}">Перейти</a>--}}
                    {{--</div>--}}
                        <div  class="col-xs-12 col-md-4">
                            <div class="offer offer-info">
                                <div class="shape">
                                    <div class="shape-text">
                                        New
                                    </div>
                                </div>
                                <div >
                                    <img style="display: block; margin: 0 auto;" width="35%" src="/uploads/services/medium/{{$service->image}}" alt="{{$service->alt}}" title="{{$service->title}}"/>
                                </div>

                                <div class="offer-content">
                                    <h3 class="lead">
                                        {{$service->title}}
                                    </h3>
                                    <p>
                                        {{$service->short_text}}
                                    </p>
                                    <a href="/projects/{{$project->slug}}/{{$service->slug}}" class="btn btn-primary btn-block">Перейти к сервису</a>
                                </div>
                            </div>
                        </div>

                    @endif
                @endforeach
            </div>
        </div>
    </div>
@stop
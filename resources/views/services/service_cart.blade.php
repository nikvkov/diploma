{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

@section('content')
    <div class = "row">
        <div class = "col-md-12">
            <div class="btn-group btn-breadcrumb">
                <a class="btn btn-default" href="/" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a class="btn btn-default" href="/projects/" >Проекты</a>
                <a class="btn btn-default" href="/projects/{{$parent_uri}}" >Проект</a>
                <a class="btn btn-default active" href="/projects/{{$parent_uri}}/{{$service->slug}}" >Сервис</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>{{$service->title}}</h1>
            <img src="/uploads/services/medium/{{$service->image}}" />
            <div class="content">
                {!!$service->content!!}
            </div>
        </div>
    </div>

    @if($service->slug == "service-bad-links")
        @include('components.services.service-bad-links')
    @elseif($service->slug == "service-get-all-links")
        @include('components.services.service-get-links')
    @elseif($service->slug == "service-sitemap-generator")
        @include('components.services.service-sitemap-generator')
    @endif
@stop
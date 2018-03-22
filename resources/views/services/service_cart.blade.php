{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

@section('content')
    <div class = "row">
        <div class = "col-md-12">
            <div class="btn-group btn-breadcrumb">
                <a class="btn btn-default" href="/" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a class="btn btn-default" href="/projects/" >Проекты</a>
                <a class="btn btn-default" href="/projects/{{$service->project->slug}}" >{{$service->project->title}}</a>
                <a class="btn btn-default active" href="/projects/{{$service->project->slug}}/{{$service->slug}}" >{{$service->title}}</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>{{$service->title}}</h1>
            <img style="float: left; margin: 10px; width: 20%" src="/uploads/services/medium/{{$service->image}}" />
            <div class="content">
                {!!$service->content!!}
            </div>
        </div>
    </div>

    {{--добавляем вывод контента для конкретоного сервиса--}}
    @if($service->slug == "service-bad-links")
        @include('components.services.service-bad-links')
    @elseif($service->slug == "service-get-all-links")
        @include('components.services.service-get-links')
    @elseif($service->slug == "service-sitemap-generator")
        @include('components.services.service-sitemap-generator')
    @elseif($service->slug == "marketplace-amazon")
        @include('components.services.service-marketplace-amazon')
    @elseif($service->slug == "marketplace-yandex-market")
        @include('components.services.service-marketplace-yandex')
    @elseif($service->slug == "amazon-sponsored-products")
        @include('components.services.service-amazon-sponsored-products')
    @elseif($service->slug == "yandex-direct")
        @include('components.services.service-yandex-direct')
    @elseif($service->slug == "google-merchant-center")
        @include('components.services.service-google-merchant-center')
    @endif
@stop
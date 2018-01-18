{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

{{--подключение основного содержимого страницы--}}
@section('content')

    <h1>О нас</h1>
    <div class="row">
        <div class="col-md-6">
            {!! $about->content !!}
        </div>
        <div class="col-md-6">
            <img src="/uploads/about/{{$about->image}}">
        </div>
    </div>

@stop
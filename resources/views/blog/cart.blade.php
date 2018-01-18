{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

{{--подключение основного содержимого страницы--}}
@section('content')

    <h1>{{$record->title}}</h1>
    <div class="content">
        <img src="/uploads/blog/medium/{{$record->image}}" style="float:left">
        <p>{!! $record->body !!}</p>
    </div>

@stop
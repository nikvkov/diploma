{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

{{--подключение основного содержимого страницы--}}
@section('content')

    {{--вывод проектов во view--}}
    @foreach($projects as $id)
        {{--<p >{{$id->id}}</p>--}}
        {{--<p >{{$id->$projects}}</p>--}}

        {{--проверка на четность--}}
        @if(($id->id % 2)==0)
            @include('partials.project_odd',['project'=>$id])
        @else
            @include('partials.project_even',['project'=>$id])
        @endif

    @endforeach

@stop
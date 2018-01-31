{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

{{--подключение основного содержимого страницы--}}
@section('content')
    <div class = "row">
        <div class = "col-md-12">
            <div class="btn-group btn-breadcrumb">
                <a class="btn btn-default" href="/" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a class="btn btn-default" href="/projects/" >Проекты</a>
            </div>
        </div>
    </div>
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
        <hr>
    @endforeach

@stop
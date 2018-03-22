{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

{{--подключение основного содержимого страницы--}}
@section('content')
    <div class = "row">
        <div class = "col-md-12">
            <div class="btn-group btn-breadcrumb">
                <a class="btn btn-default" href="/" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a class="btn btn-default active" href="/projects/" >Проекты</a>
            </div>
        </div>
    </div>

    <div class="row">
        <section id="team" >
            <div class="container">

                <h5 class="section-title h1">Доступные проекты</h5>
                <hr>
                <div class="row">
                    {{--вывод проектов во view--}}
                    @foreach($projects as $id)


                        @include('partials.project_odd',['project'=>$id])
                        {{--<p >{{$id->id}}</p>--}}
                        {{--<p >{{$id->$projects}}</p>--}}

                        {{--проверка на четность--}}
                        {{--@if(($id->id % 2)==0)--}}
                            {{--@include('partials.project_odd',['project'=>$id])--}}
                        {{--@else--}}
                            {{--@include('partials.project_even',['project'=>$id])--}}
                        {{--@endif--}}

                    @endforeach
                    <hr>
                </div>
            </div>
        </section>
    </div>

@stop
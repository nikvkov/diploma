{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

{{--подключение основного содержимого страницы--}}
@section('content')

    {{--вывод слайдов во view--}}
    @foreach($slides as $slide)
        <img src="/uploads/slides/small/{{$slide->image}}" alt="" />
    @endforeach

@stop
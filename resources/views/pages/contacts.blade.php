{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

{{--подключение основного содержимого страницы--}}
@section('content')

    <h1>Контакты</h1>
    <div class="row">
        <div class="col-md-12">
            <img src="/uploads/contacts/{{$contacts->image}}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $contacts->content !!}
        </div>
    </div>

@stop
{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{$project->title}}</h1>
            <img src="/uploads/project/large/{{$project->image}}" />
            <div class="content">
                {!!$project->content!!}
            </div>

            <div class="row">
                @foreach($project->galleries as $image)
                    <div class="col-md-6">
                        <img src="/uploads/images/medium/{{$image->image}}" alt="{{$image->alt}}" title="{{$image->title}}"/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
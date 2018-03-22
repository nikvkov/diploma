{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

{{--подключение основного содержимого страницы--}}
@section('content')

    <div class="row blog-row">
        <h1 class="text-center margin_bottom30">{{$record->title}}</h1>
        <div class="col-md-12 col-sm-12 col-xs-12 margin_bottom30">
            {{--<a href="#">--}}
                {{--<img style="float: left; margin: 0; width: 15%" class="img-responsive center-block" src="/uploads/blog/medium/{{$record->image}}" height="250">--}}
            {{--</a>--}}
            <div class="blog-content bg-white">
                <img style="float: left; margin: 0 15px; width: 25%" class="img-responsive center-block" src="/uploads/blog/medium/{{$record->image}}" height="250">

                {{--<h3>{{$record->title}}</h3>--}}
                {{--<p>Category : <a href="javascript::;">Nature</a></p>--}}
                <p>{!! $record->body !!}</p>
                <hr>
                <p><span>Share :
				<a href="#"><i class="fa fa-facebook margin_left10" aria-hidden="true"></i></a>
				<a href="#"><i class="fa fa-twitter margin_left10" aria-hidden="true"></i></a>
				<a href="#"><i class="fa fa-google-plus margin_left10" aria-hidden="true"></i></a>
				 </span>
                    <span class="pull-right">От : <strong>Nikolaj Kovalenko</strong></span> </p>
            </div>
        </div>
    </div>

    {{--<h1>{{$record->title}}</h1>--}}
    {{--<div class="content">--}}
        {{--<img src="/uploads/blog/medium/{{$record->image}}" style="float:left">--}}
        {{--<p>{!! $record->body !!}</p>--}}
    {{--</div>--}}

@stop
{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

{{--подключение основного содержимого страницы--}}
@section('content')

    <h1>Список публикаций</h1>

    @foreach($records as $item)
    <section class="col-xs-12 col-sm-6 col-md-12">
        <article class="search-result row">
            <div class="col-xs-12 col-sm-12 col-md-1">
                <a href="/blog/{{$item->slug}}" title="Читать новость" class="thumbnail"><img src="/uploads/blog/small/{{$item->image}}" alt="Lorem ipsum" /></a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
                <ul class="meta-search">
                    <li><i class="glyphicon glyphicon-calendar"></i> <span>{{(new DateTime($item->created_at))->format('F j, Y')}}</span></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                <h3><a href="/blog/{{$item->slug}}" title="">{{$item->title}}</a></h3>
                <p>{!! mb_substr( strip_tags($item->body),0,150 )!!}...</p>
                <span class="plus"><a href="/blog/{{$item->slug}}" title="Читать новость"><i class="glyphicon glyphicon-book"></i></a></span>
            </div>
            <span class="clearfix borda"></span>
        </article>
        <hr>
    </section>
    @endforeach;




    {{--@foreach($records as $item)--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-2">--}}
            {{--<img src="/uploads/blog/small/{{$item->image}}"/>--}}
        {{--</div>--}}
        {{--<div class="col-md-10">--}}
            {{--<h2>{{$item->title}}</h2>--}}
            {{--<div class="content">--}}
                {{--{!! mb_substr( strip_tags($item->body),0,150 )!!}...--}}
            {{--</div>--}}
            {{--<a href="/blog/{{$item->slug}}" style="width: 100px" class="btn btn-primary btn-block">Подробнее</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach;--}}

    @include('partials.paginate',['pager'=>$records])

@stop
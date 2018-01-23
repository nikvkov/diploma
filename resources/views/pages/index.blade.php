{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

{{--подключение основного содержимого страницы--}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-header">Последние новости</h3>
        </div>
    </div>
    <div class="row">
            @for($i=0; $i<3 ;$i++)
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-2">
                            <img style="width: 75%;" src="/uploads/blog/small/{{$news[$i]->image}}"/>
                        </div>
                        <div class="col-md-10">
                            <h2>{{$news[$i]->title}}</h2>
                            <div class="content">
                                {!! mb_substr( strip_tags($news[$i]->body),0,150 )!!}...
                            </div>
                            <a href="/blog/{{$news[$i]->slug}}">Read more</a>
                        </div>
                    </div>

                </div>

            @endfor

    </div>
    <div class="row">
        <div class="col-md-6">
            <h4 class="page-header">Заголовок 1</h4>
            <p class="text-justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut nisl fringilla nibh volutpat dictum. Fusce commodo mi metus, ac suscipit augue semper at. Vestibulum placerat, velit ac ultrices consectetur, leo nisi dignissim sem, id dapibus diam nulla quis nunc. Donec aliquam ullamcorper vehicula. Proin blandit, mi quis tempus semper, sapien mi venenatis felis, eu convallis lacus velit a sapien. Maecenas semper magna in felis egestas, sit amet vulputate mauris pellentesque. Nam congue urna nec ante imperdiet, fermentum dignissim leo gravida. Integer ac ultrices mauris, a malesuada mauris. Aenean eget eleifend odio. Praesent malesuada lacinia tortor, quis accumsan ligula placerat eget. Suspendisse non elit imperdiet nisl dapibus vulputate. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce finibus fermentum ante, eget congue enim cursus non. Praesent rutrum mi eu erat dignissim, in scelerisque turpis ullamcorper. Suspendisse et neque lacinia, tincidunt lacus ut, maximus ligula.
            </p>

        </div>
        <div class="col-md-6">
            <h4 class="page-header">Заголовок 2</h4>
            <p class="text-justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut nisl fringilla nibh volutpat dictum. Fusce commodo mi metus, ac suscipit augue semper at. Vestibulum placerat, velit ac ultrices consectetur, leo nisi dignissim sem, id dapibus diam nulla quis nunc. Donec aliquam ullamcorper vehicula. Proin blandit, mi quis tempus semper, sapien mi venenatis felis, eu convallis lacus velit a sapien. Maecenas semper magna in felis egestas, sit amet vulputate mauris pellentesque. Nam congue urna nec ante imperdiet, fermentum dignissim leo gravida. Integer ac ultrices mauris, a malesuada mauris. Aenean eget eleifend odio. Praesent malesuada lacinia tortor, quis accumsan ligula placerat eget. Suspendisse non elit imperdiet nisl dapibus vulputate. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce finibus fermentum ante, eget congue enim cursus non. Praesent rutrum mi eu erat dignissim, in scelerisque turpis ullamcorper. Suspendisse et neque lacinia, tincidunt lacus ut, maximus ligula.
            </p>
        </div>
    </div>

    {{--вывод слайдов во view--}}
    {{--@foreach($slides as $slide)--}}
        {{--<img src="/uploads/slides/small/{{$slide->image}}" alt="" />--}}
    {{--@endforeach--}}

@stop
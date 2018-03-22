{{--подключение общего для всех страниц контента - меню--}}
@extends('layouts.default')

@section('content')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
{{--<body class="home">--}}
<div id="mainContainer">
<div  class="container-fluid display-table">
    <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
            {{--<div class="logo">--}}
                {{--<a hef="home.html"><img src="http://jskrishna.com/work/merkury/images/logo.png" alt="merkery_logo" class="hidden-xs hidden-sm">--}}
                    {{--<img src="http://jskrishna.com/work/merkury/images/circle-logo.png" alt="merkery_logo" class="visible-xs visible-sm circle-logo">--}}
                {{--</a>--}}
            {{--</div>--}}
            <div class="navi">
                <ul>
                    <li onclick="showPage('files')" class="active"><a href="#"><i class="glyphicon glyphicon-cd" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Файлы</span></a></li>
                    <li onclick="showPage('orders')"><a href="#"><i class="glyphicon glyphicon-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Отчеты</span></a></li>
                    <li onclick="showPage('statistic')"><a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Статистика</span></a></li>
                    <li onclick="showPage('person')"><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Профиль</span></a></li>
                    <li onclick="showPage('message')"><a href="#"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Сообщения</span></a></li>
                    <li onclick="showPage('events')"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Календарь</span></a></li>
                    {{--<li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Настройки</span></a></li>--}}
                </ul>
            </div>
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
            <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
            <div class="row">
                <header>
                    <div class="col-md-7">
                        <nav class="navbar-default pull-left">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                        </nav>
                        <div class="search hidden-xs hidden-sm">
                            <input id = "search_filename" type="text" placeholder="Поиск" >
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="header-rightside">
                            <ul class="list-inline header-top pull-right">
                                <li class="hidden-xs"><button onclick="searchFile()" class="add-project">Найти файл</button></li>

                                {{--<li class="hidden-xs"><a href="#" class="add-project" data-toggle="modal" data-target="#add_project">Найти отчет</a></li>--}}
                                <li onclick="showPage('message')">
                                    <a href="#" class="icon-info">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    @if(count($message->getAllNonReadMessages())>0) <span class="label label-primary">{{count($message->getAllNonReadMessages())}}</span> @endif
                                    </a>
                                </li>
                                <li onclick="showPage('events')">
                                    <a href="#" class="icon-info">
                                        <i class="fa fa-bell" aria-hidden="true"></i>
                                        @if(count($event->getAllNonReadEvents())>0) <span class="label label-primary">{{count($event->getAllNonReadEvents())}}</span> @endif
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="/uploads/user.png" alt="Пользователь">
                                        <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="navbar-content">
                                                <span>{{$user->name}}</span>
                                                <p class="text-muted small">
                                                    {{$user->email}}
                                                </p>
                                                <div class="divider">
                                                </div>
                                                <a onclick="showPage('person')" href="#" class="view btn-sm active">Показать профиль</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>
            </div>
            <div class="user-dashboard">
                <h3>Здравствуйте, {{$user->name}}</h3>
                {{--<div id="admin_loader" style="margin-top: 20px;" class="row">--}}
                    {{--<div class="container">--}}
                    {{--<div class="ring">--}}
                        {{--Loading--}}
                        {{--<span id = "id_span"></span>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--вывод круговых прогрессбаров--}}
                    <div style="margin-top: 20px;" class="row">

                        <div class="col-md-3 col-sm-6">
                            <h4>Общее количество файлов</h4>
                            <div class="progress blue">
                                <span class="progress-left">
                                    <span class="progress-bar"></span>
                                </span>
                                <span class="progress-right">
                                    <span class="progress-bar"></span>
                                </span>
                                <div class="progress-value">{{count($all_files)}}/300</div>
                            </div>
                            <button onclick="ma_showAllUserFile()" class="view btn-sm active">Показать</button>
                            <button onclick="ma_showDetailData(0)" class="view btn-sm active">Подробнее</button>
                            <button onclick="ma_createOrderAllUserFile()" class="view btn-sm active">Отчет</button>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h6>Формирование файла загрузки для запуска рекламных кампаний</h6>
                            <div class="progress yellow">
                                <span class="progress-left">
                                    <span class="progress-bar"></span>
                                </span>
                                <span class="progress-right">
                                    <span class="progress-bar"></span>
                                </span>
                                <div class="progress-value">{{count($project1)}}</div>
                            </div>
                            <button onclick="ma_showProjectUserFile(1)" class="view btn-sm active">Показать</button>
                            <button onclick="ma_showDetailData(1)" class="view btn-sm active">Подробнее</button>
                            <button onclick="ma_createOrderAtProjectUserFile(1)" class="view btn-sm active">Отчет</button>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h6>Перенос товаров сайта на торговую площадку</h6>
                            <div class="progress pink">
                                <span class="progress-left">
                                    <span class="progress-bar"></span>
                                </span>
                                <span class="progress-right">
                                    <span class="progress-bar"></span>
                                </span>
                                <div class="progress-value">{{count($project2)}}</div>
                            </div>
                            <button onclick="ma_showProjectUserFile(2)" class="view btn-sm active">Показать</button>
                            <button onclick="ma_showDetailData(2)" class="view btn-sm active">Подробнее</button>
                            <button onclick="ma_createOrderAtProjectUserFile(2)" class="view btn-sm active">Отчет</button>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h6>Сервисы тестирования и оптимизации сайтов</h6>
                            <div class="progress green">
                                <span class="progress-left">
                                    <span class="progress-bar"></span>
                                </span>
                                <span class="progress-right">
                                    <span class="progress-bar"></span>
                                </span>
                                <div class="progress-value">{{count($project3)}}</div>
                            </div>
                        </div>
                        <button onclick="ma_showProjectUserFile(3)" class="view btn-sm active">Показать</button>
                        <button onclick="ma_showDetailData(3)" class="view btn-sm active">Подробнее</button>
                        <button onclick="ma_createOrderAtProjectUserFile(3)" class="view btn-sm active">Отчет</button>
                    </div>



                <div id="detailData" style="margin-top: 20px;" class="row">



                </div>

                <div id="dataForFiles" style="margin-top: 20px;" class="row">



                </div>

                {{--<div class="row">--}}
                    {{--<div class=" col-sm-6">--}}
                        {{--<div class="progress green">--}}
                {{--<span class="progress-left">--}}
                    {{--<span class="progress-bar"></span>--}}
                {{--</span>--}}
                            {{--<span class="progress-right">--}}
                    {{--<span class="progress-bar"></span>--}}
                {{--</span>--}}
                            {{--<div class="progress-value">90%</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class=" col-sm-6">--}}
                        {{--<div class="progress light">--}}
                {{--<span class="progress-left">--}}
                    {{--<span class="progress-bar"></span>--}}
                {{--</span>--}}
                            {{--<span class="progress-right">--}}
                    {{--<span class="progress-bar"></span>--}}
                {{--</span>--}}
                            {{--<div class="progress-value">75%</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<div id="containerLoader"></div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-5 col-sm-5 col-xs-12 gutter">--}}

                        {{--<div class="sales">--}}
                            {{--<h2>Your Sale</h2>--}}

                            {{--<div class="btn-group">--}}
                                {{--<button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                    {{--<span>Период :</span> Последний год--}}
                                {{--</button>--}}
                                {{--<div class="dropdown-menu">--}}
                                    {{--<a href="#">2012</a>--}}
                                    {{--<a href="#">2014</a>--}}
                                    {{--<a href="#">2015</a>--}}
                                    {{--<a href="#">2016</a>--}}
                                    {{--<a href="#">2017</a>--}}
                                    {{--<a href="#">2018</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-7 col-sm-7 col-xs-12 gutter">--}}

                        {{--<div class="sales report">--}}
                            {{--<h2>Report</h2>--}}
                            {{--<div class="btn-group">--}}
                                {{--<button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                    {{--<span>Период :</span> Last Year--}}
                                {{--</button>--}}
                                {{--<div class="dropdown-menu">--}}
                                    {{--<a href="#">2012</a>--}}
                                    {{--<a href="#">2014</a>--}}
                                    {{--<a href="#">2015</a>--}}
                                    {{--<a href="#">2016</a>--}}
                                    {{--<a href="#">2017</a>--}}
                                    {{--<a href="#">2018</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>

</div>



<!-- Modal -->
<div id="add_project" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header login-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add Project</h4>
            </div>
            <div class="modal-body">
                <input type="text" placeholder="Project Title" name="name">
                <input type="text" placeholder="Post of Post" name="mail">
                <input type="text" placeholder="Author" name="passsword">
                <textarea placeholder="Desicrption"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel" data-dismiss="modal">Close</button>
                <button type="button" class="add-project" data-dismiss="modal">Save</button>
            </div>
        </div>

    </div>
</div>

<style>
    @keyframes loading-1{
        0%{
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100%{
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
    }
    @keyframes loading-2{
        0%{
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100%{
            -webkit-transform: rotate({{round((360*count($all_files)/300),0)}}deg);
            transform: rotate({{round((360*count($all_files)/300),0)}}deg);
        }
    }
    @keyframes loading-3{
        0%{
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100%{
            -webkit-transform: rotate({{round((360*count($project1)/300),0)}}deg);
            transform: rotate({{round((360*count($project1)/300),0)}}deg);
        }
    }
    @keyframes loading-4{
        0%{
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100%{
            -webkit-transform: rotate({{round((360*count($project2)/300),0)}}deg);
            transform: rotate({{round((360*count($project2)/300),0)}}deg);
        }
    }
    @keyframes loading-5{
        0%{
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100%{
            -webkit-transform: rotate({{round((360*count($project3)/100),0)}}deg);
            transform: rotate({{round((360*count($project3)/100),0)}}deg);
        }

    }
</style>
</div>

{{--</body>--}}
@stop
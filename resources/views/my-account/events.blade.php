<!-- Modal -->
<div class="modal fade" id="modalMessage"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog" style="width: 850px; height: 600px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="myModalLabel">Просмотр события</h4>
            </div>
            <div id = "prevMessage" class="modal-body">

            </div>
            <div class="modal-footer">
                <center>
                    <button onclick="showPage('events');" type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </center>
            </div>
        </div>
    </div>
</div>




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
                    <li onclick="showPage('files')"><a href="#"><i class="glyphicon glyphicon-cd" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Файлы</span></a></li>
                    <li onclick="showPage('orders')"><a href="#"><i class="glyphicon glyphicon-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Отчеты</span></a></li>
                    <li onclick="showPage('statistic')"><a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Статистика</span></a></li>
                    <li onclick="showPage('person')"><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Профиль</span></a></li>
                    <li onclick="showPage('message')"><a href="#"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Сообщения</span></a></li>

                    <li class="active" onclick="showPage('events')"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Календарь</span></a></li>
                    {{--<li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Настройки</span></a></li>--}}
                </ul>
            </div>
        </div>
        <div class="col-md-10 col-sm-10 display-table-cell v-align">
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
                            <input id = "search_event" type="text" placeholder="Поиск">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="header-rightside">
                            <ul class="list-inline header-top pull-right">
                                <li class="hidden-xs"><button onclick="searchEvent()" class="add-project">Найти событие</button></li>

                                {{--<li class="hidden-xs"><a href="#" class="add-project" data-toggle="modal" data-target="#add_project">Найти отчет</a></li>--}}
                                <li onclick="showPage('message')">
                                    <a href="#" class="icon-info">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        @if(count($message->getAllNonReadMessages())>0) <span id="countMessage" class="label label-primary">{{count($message->getAllNonReadMessages())}}</span> @endif
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

                {{--вывод панелей с данными--}}
                <div style="margin-top: 20px;" class="row">

                    <div id="search_item" class="col-md-8">
                    @foreach($event->getAllEvents() as $item)

                            <div class="well @if($item->read != 0) read @endif" id="postlist">
                                <div onclick="ma_showEvents({{$item->event->id}})" class="panel">
                                    <div class="panel-heading">
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <h3 class="pull-left"><span class="label label-default"><i class="glyphicon glyphicon-send"></i> {{$item->event->title}}</span></h3>
                                                </div>
                                                <div class="col-sm-3">
                                                    <h4 class="pull-right">
                                                        <small><em>{{(new DateTime($item->created_at))->format('F j, Y')}}<br>{{(new DateTime($item->created_at))->format('g:i a')}}</em></small>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="/uploads/events/small/{{$item->event->image}}">
                                            </div>
                                            <div class="col-md-6">
                                                {!! mb_substr( strip_tags($item->event->body),0,150 )!!}... 
                                            </div>
                                            <div class="col-md-3">
                                                <button onclick="ma_showEvents({{$item->event->id}})" class="view btn-sm active" >Подробнееe</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-footer">
                                        {{--<span class="label label-default">Welcome</span> <span class="label label-default">Updates</span> <span class="label label-default">July</span>--}}
                                    </div>
                                </div>
                            </div>

                    @endforeach
                    </div>

                    <div class="col-md-offset-2 col-md-2">
                        <button style="width: 200px" onclick="showPage('events');" class="view btn-sm active" >Все</button><br/><br/>
                        <button style="width: 200px" onclick="showReadEvents()" class="view btn-sm active" >Прочитанные</button><br/><br/>
                        <button style="width: 200px" onclick="showNoReadEvents()" class="view btn-sm active" >Не прочитанные</button>
                    </div>
                </div>




                <div id="detailData" style="margin-top: 20px;" class="row">



                </div>

                <div id="dataForFiles" style="margin-top: 20px;" class="row">



                </div>

            </div>
        </div>
    </div>

</div>

<style>
    .well{
        border-radius:15px
    }
    .well:hover{
        border: black 2px;
        background-color: #666666;
        cursor: pointer;

    }

    .read{
        background-color: #66FF99;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="modalMessage"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog" style="width: 850px; height: 600px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="myModalLabel">Просмотр</h4>
            </div>
            <div class="modal-body">
               <iframe height="500px" width="800px" id = "prevMessage" srcdoc="">

               </iframe>
            </div>
            <div class="modal-footer">
                <center>
                    <button onclick="closeModal()" type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
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
                    <li class="active" onclick="showPage('message')"><a href="#"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Сообщения</span></a></li>

                    <li onclick="showPage('events')"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Календарь</span></a></li>
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
                            <input id = "search_message" type="text" placeholder="Поиск">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="header-rightside">
                            <ul class="list-inline header-top pull-right">
                                <li class="hidden-xs"><button onclick="searchMessage()" class="add-project">Найти сообщение</button></li>

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
                    @foreach($message->getAllMessages() as $item)
                    <div id = "message{{$item->id}}" class="well @if($item->read != 0) read @endif"  onclick="ma_showMessage({{$item->id}})" >
                        <div class="media">
                            <a style="margin-right: 70px" class="pull-left" href="#">
                                <img class="media-object" src="/uploads/admin/no-read-mail.png">
                                <button onclick="ma_showMessage({{$item->id}})" class="view btn-sm active">Показать</button>
                            </a>
                            {{--<div class="pull-left">--}}
                                {{--<iframe--}}
                                {{--srcdoc="{{$item->content}}" width="750px" height="300px" >--}}
                                {{--</iframe>--}}
                            {{--</div>--}}
                            <div class="media-body" style="margin-left: 70px">
                                <h4 class="media-heading">Извещение</h4>
                                <p class="text-right">      от сервиса</p>
                                <p class="lead"> {{$item->title}}</p>

                                <ul class="list-inline list-unstyled">
                                    <li><span><i class="glyphicon glyphicon-calendar"></i>{{(new DateTime($item->created_at))->format('F j, Y, g:i a')}}</span></li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    </div>

                    <div class="col-md-offset-2 col-md-2">
                        <button style="width: 200px" onclick="showPage('message');" class="view btn-sm active" >Все</button><br/><br/>
                        <button style="width: 200px" onclick="showReadMessages()" class="view btn-sm active" >Прочитанные</button><br/><br/>
                        <button style="width: 200px" onclick="showNoReadMessages()" class="view btn-sm active" >Не прочитанные</button>
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
    .well:hover{
        border: black 2px;
        background-color: #CCFFFF;
        cursor: pointer;
    }

    .read{
        background-color: #66FFCC;
    }
</style>

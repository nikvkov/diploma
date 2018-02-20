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
                    <li class="active" onclick="showPage('orders')"><a href="#"><i class="glyphicon glyphicon-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Отчеты</span></a></li>
                    <li onclick="showPage('statistic')"><a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Статистика</span></a></li>
                    <li onclick="showPage('person')"><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Профиль</span></a></li>
                    <li onclick="showPage('message')"><a href="#"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Сообщения</span></a></li>

                    <li onclick="showPage('events')"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Календарь</span></a></li>
                    <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Настройки</span></a></li>
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
                            <input id = "search_order" type="text" placeholder="Поиск">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="header-rightside">
                            <ul class="list-inline header-top pull-right">
                                <li class="hidden-xs"><button onclick="searchOrder()" class="add-project">Найти отчет</button></li>

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

                {{--вывод панелей с данными--}}
                <div style="margin-top: 20px;" class="row">

                    <div class="col-sm-3">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="glyphicon glyphicon-tasks"></i>
                            </div>
                            <div class="text">

                                <label class="text-muted">Все отчеты</label><br/>
                                <var class="text-center">{{count($all_orders)}}</var>
                            </div>
                            <br/>
                            <div class="options">
                                <button onclick="ma_showAllUserOrder()" class="btn btn-default btn-lg orders-page"><i class="glyphicon glyphicon-eye-open"></i>&emsp; Показать</button>
                                <button onclick="ma_showDetailDataForOrder(0)" style="margin-top: 10px" class="btn btn-default btn-lg orders-page"><i class="glyphicon glyphicon-th-large"></i>&emsp; Детальнее</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="glyphicon glyphicon-tasks"></i>
                            </div>
                            <div class="text">

                                <label class="text-muted">Перенос товаров на другую CMS</label><br/>
                                <var class="text-center">{{count($project1)}}</var>
                            </div>
                            <div class="options">
                                <button onclick="ma_showProjectUserOrder(1)" class="btn btn-default btn-lg orders-page"><i class="glyphicon glyphicon-eye-open"></i>&emsp; Показать</button>
                                <button onclick="ma_showDetailDataForOrder(1)" style="margin-top: 10px" class="btn btn-default btn-lg orders-page"><i class="glyphicon glyphicon-th-large"></i>&emsp; Детальнее</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="glyphicon glyphicon-tasks"></i>
                            </div>
                            <div class="text">

                                <label class="text-muted">Перенос товаров на торговую площадку</label><br/>
                                <var class="text-center">{{count($project2)}}</var>
                            </div>
                            <div class="options">
                                <button onclick="ma_showProjectUserOrder(2)" class="btn btn-default btn-lg orders-page"><i class="glyphicon glyphicon-eye-open"></i>&emsp; Показать</button>
                                <button onclick="ma_showDetailDataForOrder(2)" style="margin-top: 10px" class="btn btn-default btn-lg orders-page"><i class="glyphicon glyphicon-th-large"></i>&emsp; Детальнее</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="glyphicon glyphicon-tasks"></i>
                            </div>
                            <div class="text">

                                <label class="text-muted">Сервисы для сайтов</label><br/>
                                <var class="text-center">{{count($project3)}}</var>
                            </div>
                            <br/>
                            <div class="options">
                                <button onclick="ma_showProjectUserOrder(3)" class="btn btn-default btn-lg orders-page"><i class="glyphicon glyphicon-eye-open"></i>&emsp; Показать</button>
                                <button onclick="ma_showDetailDataForOrder(3)" style="margin-top: 10px" class="btn btn-default btn-lg orders-page"><i class="glyphicon glyphicon-th-large"></i>&emsp; Детальнее</button>
                            </div>
                        </div>
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
<!-- Форма -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Закрыть</span></button>
                <h3 class="modal-title" id="lineModalLabel">Дополнительные данные пользователя</h3>
            </div>
            <div class="modal-body">

                <!-- content goes here -->
                <form>
                    <div class="form-group">
                        <label for="addInputTel">Телефон</label>
                        <input type="tel" pattern="+[0-9]{5,15}" value="@if(!empty($user->person)) {{ $user->person->tel }} @endif" class="form-control" id="addInputTel" placeholder="+380999999999">
                        <p class="help-block">Укажите телефон для связи.</p>
                    </div>
                    <div class="form-group">
                        <label for="addInputSkype">Skype</label>
                        <input type="text" class="form-control" id="addInputSkype" value="@if(!empty($user->person)) {{$user->person->skype}}  @endif" placeholder="skype login">
                        <p class="help-block">Укажите запись Skype</p>
                    </div>
                    <div class="form-group">
                        <label for="addInputCountry">Страна</label>
                        <input type="text" id="addInputCountry" value="@if(!empty($user->person)) {{ $user->person->country }} @endif">
                        <p class="help-block">Укажите страну проживания.</p>
                    </div>

                    <div class="form-group">
                        <label for="addInputCity">Город</label>
                        <input type="text" id="addInputCity" value="@if(!empty($user->person)) {{ $user->person->city }} @endif">
                        <p class="help-block">Укажите город проживания.</p>
                    </div>

                    <div class="form-group">
                        <label for="addInputDate">Дата рождения</label>
                        <input type="date"  id="addInputDate" value="@if(!empty($user->person)) {{ $user->person->birth_date}} @endif">
                        <p class="help-block">Укажите дату рождения</p>
                    </div>

                    {{--<button type="submit" class="btn btn-default">Submit</button>--}}
                </form>

            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Закрыть</button>
                    </div>
                    {{--<div class="btn-group btn-delete hidden" role="group">--}}
                        {{--<button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>--}}
                    {{--</div>--}}
                    <div class="btn-group" role="group">
                        <button type="button" onclick="additionalData()" id="saveAdditionalData" class="btn btn-default btn-hover-green" data-dismiss="modal" role="button">Сохранить</button>
                    </div>
                </div>
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
                    <li class="active" onclick="showPage('person')"><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Профиль</span></a></li>
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
                        {{--<div class="search hidden-xs hidden-sm">--}}
                            {{--<input id = "search_order" type="text" placeholder="Поиск">--}}
                        {{--</div>--}}
                    </div>
                    <div class="col-md-5">
                        <div class="header-rightside">
                            <ul class="list-inline header-top pull-right">
                                {{--<li class="hidden-xs"><button onclick="searchOrder()" class="add-project">Найти отчет</button></li>--}}

                                {{--<li class="hidden-xs"><a href="#" class="add-project" data-toggle="modal" data-target="#add_project">Найти отчет</a></li>--}}
                                <li onclick="showPage('message')">
                                    <a href="#" class="icon-info">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        @if( isset($message) && count($message->getAllNonReadMessages())>0) <span class="label label-primary">{{count($message->getAllNonReadMessages())}}</span> @endif
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
        <div class="col-md-10 col-sm-11 display-table-cell v-align">

            <div class="user-dashboard">

                {{--вывод панелей с данными--}}
                <div style="margin-top: 20px;" class="row">

                    <div class="col-sm-3 col-md-3">
                        <img src="/uploads/user.png"
                             alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <blockquote class="text-success">
                            <p class="lead">{{$user->name}}</p> <small><cite title="Source Title">Активный пользователь  <i class="glyphicon glyphicon-leaf"></i></cite></small>
                        </blockquote>
                        <p class="text text-primary lead" > <i class="glyphicon glyphicon-envelope"></i> {{$user->email}}
                            <br/>
                            <br/>
                            <span class="text text-success">Дополнительные данные</span>
                            <br/><i class="glyphicon glyphicon-phone"></i> @if(!empty($user->person)) {{ $user->person->tel }} @endif
                            <br/><i>S</i> @if(!empty($user->person)) {{ $user->person->skype }} @endif
                            <br/><i class="glyphicon glyphicon-globe"></i> @if(!empty($user->person)) {{ $user->person->country }} @endif
                            <br/><i class="glyphicon glyphicon-globe"></i> @if(!empty($user->person)) {{ $user->person->city }} @endif
                            <br /> <i class="glyphicon glyphicon-gift"></i> @if(!empty($user->person)) {{ $user->person->birth_date }} @endif</p>
                    </div>
                    <div class="col-sm-1 col-md-3">
                        <button data-toggle="modal" data-target="#squarespaceModal" class="view btn-sm active">Редактировать личную информацию</button>
                        <a href="/password/reset" class="view btn-sm active">Сбросить пароль</a>
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
    .form-control{
        height: 45px;
    }

    .modal-header {
        padding-bottom: 5px;
    }

    .modal-footer {
        padding: 0;
    }

    .modal-footer .btn-group button {
        height:40px;
        border-top-left-radius : 0;
        border-top-right-radius : 0;
        border: none;
        border-right: 1px solid #ddd;
    }

    .modal-footer .btn-group:last-child > button {
        border-right: 0;
    }
</style>




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
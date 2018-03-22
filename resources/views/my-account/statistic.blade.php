
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Дата', 'Файлы'],
            @foreach($files_stat as $row)
            {{--[{{(new DateTime($row->day))->format('F j, Y')}}, {{$row->num}}],--}}
                ['{{(new DateTime($row->day))->format('F j, Y')}}', {{$row->num}}],
            @endforeach

            // ['2004',  1000,      400],
            // ['2005',  1170,      460],
            // ['2006',  660,       1120],
            // ['2007',  1030,      540]
        ]);

        var options = {
            title: 'Статистика создания документов',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);

        data = google.visualization.arrayToDataTable([
            ['Дата', 'Отчеты'],
                @foreach($orders_stat as $row)
                {{--[{{(new DateTime($row->day))->format('F j, Y')}}, {{$row->num}}],--}}
            ['{{(new DateTime($row->day))->format('F j, Y')}}', {{$row->num}}],
            @endforeach

            // ['2004',  1000,      400],
            // ['2005',  1170,      460],
            // ['2006',  660,       1120],
            // ['2007',  1030,      540]
        ]);

         options = {
            title: 'Статистика создания отчетов',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        chart = new google.visualization.LineChart(document.getElementById('curve_chart_orders'));

        chart.draw(data, options);
    }
</script>
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
                    <li  class="active" onclick="showPage('statistic')"><a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Статистика</span></a></li>
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

                    <article class="search-result row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <a href="#" title="Files" class="thumbnail"><img src="/uploads/admin/files.png" alt="Files" /></a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2">
                            <ul class="meta-search">
                                <li><i >&sum; </i> <span>{{count($files->getAllFiles())}} &emsp; файлов</span></li>
                                <li><i class="glyphicon glyphicon-time"></i> <span>{{$files->getSumCreateTime()}} &emsp; сек</span></li>
                                <li><i class="glyphicon glyphicon-time"></i> <span>{{round($files->getAvgCreateTime(),1)}}&emsp; сек</span></li>
                                <li><i class="glyphicon glyphicon-calendar"></i> <span>{{$files->getLastTime()}}</span></li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                            <h3><a href="#" title="">Общая статистика по файлам</a></h3>
                            <p>В этом разделе отображена общая статистика по созданию документов за весь период деятельности.
                                Отображаееся количество созданных файлов, дата последнего создания, общее и седнее время создания.
                                Для получения более подробной статистики нажмите "Подробная статистика"
                            </p>
                            <span><button onclick="showPage('files')" class="btn btn-lg btn-block btn-info">Подробная статистика</button></span>
                        </div>
                        <span class="clearfix borda"></span>
                        <div class="col-md-12">
                            <div id="curve_chart" style=" height: 300px"></div>
                        </div>
                    </article>

                </div>

                <div id="detailData" style="margin-top: 20px;" class="row">



                </div>

                <div style="margin-top: 20px;" class="row">

                    <article class="search-result row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <a href="#" title="Files" class="thumbnail"><img src="/uploads/admin/orders.png" alt="Files" /></a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2">
                            <ul class="meta-search">
                                <li><i >&sum; </i> <span>{{count($orders->getAllOrders())}} &emsp; файлов</span></li>
                                <li><i class="glyphicon glyphicon-time"></i> <span>{{$orders->getSumCreateTime()}} &emsp; сек</span></li>
                                <li><i class="glyphicon glyphicon-time"></i> <span>{{round($orders->getAvgCreateTime(),1)}}&emsp; сек</span></li>
                                <li><i class="glyphicon glyphicon-calendar"></i> <span>{{$orders->getLastTime()}}</span></li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                            <h3><a href="#" title="">Общая статистика по отчетам</a></h3>
                            <p>
                                В этом разделе отображена общая статистика по созданию отчетов пользователя за весь период деятельности.
                                Отображаееся количество созданных отчетов, дата последнего создания, общее и седнее время создания.
                                Для получения более подробной статистики нажмите "Подробная статистика"
                            </p>
                            <span><button onclick="showPage('orders')" class="btn btn-lg btn-block btn-info">Подробная статистика</button></span>
                        </div>
                        <span class="clearfix borda"></span>
                    </article>
                    <div class="col-md-12">
                        <div id="curve_chart_orders" style=" height: 300px"></div>
                    </div>

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



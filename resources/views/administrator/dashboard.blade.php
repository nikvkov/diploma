{{--<style href="/lib/font-awesome/css/font-awesome.css" ></style>--}}
{{--<style href="/lib/Ionicons/css/ionicons.css"></style>--}}
{{--<style href="/lib/perfect-scrollbar/css/perfect-scrollbar.css" ></style>--}}
{{--<style href="/lib/jquery-switchbutton/jquery.switchButton.css"></style>--}}
{{--<style href="/lib/rickshaw/rickshaw.min.css" ></style>--}}
{{--<style href="/lib/chartist/chartist.css"></style>--}}
<!-- ########## START: LEFT PANEL ########## -->

{{--<div class="br-logo"><a href=""><span>[</span>bracket<span>]</span></a></div>--}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="/js/custom-admin.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Дата', 'Файлы'],
                @foreach((new App\DataFile())->getDataForDays() as $row)
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

        var chart = new google.visualization.LineChart(document.getElementById('stat'));

        chart.draw(data, options);

        // Статистика по файлам
        data = google.visualization.arrayToDataTable([
            ['Сервис', 'Количество файлов'],
            @foreach((new App\Service())->all() as $service)
                ['{{$service->title}}',     {{count($service->files)}}],
            @endforeach
            // ['Work',     11],
            // ['Eat',      2],
            // ['Commute',  2],
            // ['Watch TV', 2],
            // ['Sleep',    7]
        ]);

        options = {
            title: 'Статистика файлов по сервисам',
            pieHole: 0.4,
        };

        chart = new google.visualization.PieChart(document.getElementById('files_stat'));
        chart.draw(data, options);

        // Статистика по отчетам
        data = google.visualization.arrayToDataTable([
            ['Сервис', 'Количество отчетов'],
                @foreach((new App\Service())->all() as $service)
            ['{{$service->title}}',     {{count($service->orders)}}],
            @endforeach
            // ['Work',     11],
            // ['Eat',      2],
            // ['Commute',  2],
            // ['Watch TV', 2],
            // ['Sleep',    7]
        ]);

        options = {
            title: 'Статистика отчетов по сервисам',
            pieHole: 0.4,
        };

        chart = new google.visualization.PieChart(document.getElementById('orders_stat'));
        chart.draw(data, options);

    }
</script>

<div style="margin-top: 20px" class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">Инструменты</label>
    <div class="br-sideleft-menu">

        {{--общие сведения--}}
        <a href="/admin" class="br-menu-link active">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Общие сведения</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

       {{--Сообшения--}}
        <a href="#" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Сообщения</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
            <li onclick="showMessagesArchive()" class="nav-item"><a  href="#" class="nav-link">Все сообщения</a></li>
            <li onclick="sendNewMessage()" class="nav-item"><a href="#" class="nav-link">Отправить новое сообщение</a></li>
        </ul>

        {{--Рассылка--}}
        <a href="#" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Рассылка</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
            <li onclick="archiveMailing()" class="nav-item"><a href="#" class="nav-link">Архив</a></li>
            <li onclick="newMailing()" class="nav-item"><a href="#" class="nav-link">Новая рассылка</a></li>
        </ul>

        {{--Пользователи--}}
        <a onclick="users_page()" href="#" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-people-outline tx-24"></i>
                <span class="menu-item-label">Пользователи</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        {{--Файлы--}}
        <a onclick="files_page()" href="#" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-paper-outline tx-24"></i>
                <span class="menu-item-label">Файлы</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        {{--Отчеты--}}
        <a href="#" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-briefcase-outline tx-24"></i>
                <span class="menu-item-label">Отчеты</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
            <li onclick="users_orders_page()" class="nav-item"><a href="#" class="nav-link">Отчеты пользователя</a></li>
            <li onclick="admin_orders_page()" class="nav-item"><a href="#" class="nav-link">Отчеты администратора</a></li>
        </ul>

    </div><!-- br-sideleft-menu -->

    <label class="sidebar-label pd-x-15 mg-t-25 mg-b-20 tx-info op-9">Суммарная информация</label>

    <div class="info-list">
        <div class="d-flex align-items-center justify-content-between pd-x-15">
            <div>
                <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Всего пользователей</p>
                <h5 class="tx-lato tx-white tx-normal mg-b-0">{{count((new App\User)->getAllUsers())}}</h5>
            </div>
            <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span>
        </div><!-- d-flex -->

        <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
            <div>
                <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Всего файлов</p>
                <h5 class="tx-lato tx-white tx-normal mg-b-0">{{count((new App\DataFile())->getAllFilesForAdmin())}}</h5>
            </div>
            <span class="peity-bar" data-peity='{ "fill": ["#1C7973"], "height": 35, "width": 60 }'>4,3,5,7,12,10,4,5,11,7</span>
        </div><!-- d-flex -->

        <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
            <div>
                <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Всего отчетов</p>
                <h5 class="tx-lato tx-white tx-normal mg-b-0">{{count((new App\Order())->getAllOrdersForAdmin())}}</h5>
            </div>
            <span class="peity-bar" data-peity='{ "fill": ["#8E4246"], "height": 35, "width": 60 }'>1,2,1,3,2,10,4,12,7</span>
        </div><!-- d-flex -->

        <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
            <div>
                <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Всего сервисов</p>
                <h5 class="tx-lato tx-white tx-normal mg-b-0">{{count((new App\Service)->getActive())}}</h5>
            </div>
            <span class="peity-bar" data-peity='{ "fill": ["#9C7846"], "height": 35, "width": 60 }'>1,3,1,17,2,5,4,12,7</span>
        </div><!-- d-flex -->
    </div><!-- info-lst -->

    <br>
</div><!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->


<!-- ########## START: RIGHT PANEL ########## -->


<!-- ########## START: MAIN PANEL ########## -->
<div id = "mainPanel" class="br-mainpanel">
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">Инструменты администратора</h4>
        <p class="mg-b-0">Статистика за прошедшие сутки</p>
    </div><!-- d-flex -->

    <div class="br-pagebody mg-t-5 pd-x-30">
        <div class="row row-sm">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-teal rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Новых пользователей</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{count((new App\User)->getUsersAtDate())}}</p>
                            <span class="tx-11 tx-roboto tx-white-6">За сегодня</span>
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
                <div class="bg-danger rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-ios-paper tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Новых файлов</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{count((new App\DataFile)->getFilesAtDate())}}</p>
                            <span class="tx-11 tx-roboto tx-white-6">{{count((new App\DataFile)->getSizeFilesAtDate())}} сек</span>
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                <div class="bg-primary rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Новых отчетов</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{count((new App\Order())->getOrdersAtDate())}}</p>
                            <span class="tx-11 tx-roboto tx-white-6">{{count((new App\Order)->getSizeOrdersAtDate())}} сек</span>
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                <div class="bg-br-primary rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Новых сообщений</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{count((new App\Message())->getMessagesAtDate())}}</p>
                            <span class="tx-11 tx-roboto tx-white-6">Сервис отправил сообщение</span>
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
        </div><!-- row -->

        <div class="row row-sm mg-t-20">
            <div class="col-12">
                <div class="card pd-0 bd-0 shadow-base">
                    <div class="pd-x-30 pd-t-30 pd-b-15">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Статистика создания файлов</h6>
                                <p class="mg-b-0">Документы созданные за текущий месяц</p>
                            </div>
                            {{--<div class="tx-13">--}}
                                {{--<p class="mg-b-0"><span class="square-8 rounded-circle bg-purple mg-r-10"></span> TCP Reset Packets</p>--}}
                                {{--<p class="mg-b-0"><span class="square-8 rounded-circle bg-pink mg-r-10"></span> TCP FIN Packets</p>--}}
                            {{--</div>--}}
                        </div><!-- d-flex -->
                    </div>
                    <div class="pd-x-15 pd-b-15">
                        <div id="stat" class="br-graf br-graf-2 ht-200 ht-sm-300">

                        </div>
                    </div>
                </div><!-- card -->

                <div class="card bd-0 shadow-base pd-30 mg-t-20">
                    <div class="d-flex align-items-center justify-content-between mg-b-30">
                        <div>
                            <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Активные пользователи</h6>
                            <p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> Февраль 2018 - Март 2018</p>
                        </div>
                        <button onclick="users_page()" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">Подробнее</button>
                    </div><!-- d-flex -->

                    <table class="table table-valign-middle mg-b-0">
                        <tbody>
                        @foreach((new App\DataFile())->getActiveUsers() as $user)
                        <tr>
                            <td class="pd-l-0-force">
                                <img src="/uploads/user.png" class="wd-40 rounded-circle" alt="">
                            </td>
                            <td>
                                <h6 class="tx-inverse tx-14 mg-b-0">{{(new App\User())->getById($user->user_id)->name}}</h6>
                                <span class="tx-12">{{(new App\User())->getById($user->user_id)->email}}</span>
                            </td>
                            <td>{{(new DateTime((new App\User())->getById($user->user_id)->created_at))->format('F j, Y')}}</td>
                            <td>{{count((new App\User())->getById($user->user_id)->files)}}</td>
                            <td class="pd-r-0-force tx-center"><button onclick="users_page()" class="tx-gray-600"><i class="icon ion-more tx-18 lh-0"></i></button></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- card -->

                <div class="card shadow-base card-body pd-25 bd-0 mg-t-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="files_stat" style="width: 600px; height: 300px;"></div>
                            <div class="mg-t-20 tx-13">
                                <button onclick="files_page()" class="tx-gray-600 hover-info">Подробнее</button>
                                {{--<a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>--}}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="orders_stat" style="width: 600px; height: 300px;"></div>
                            <div class="mg-t-20 tx-13">
                                <button onclick="users_orders_page()" class="tx-gray-600 hover-info">Подробнее</button>
                                {{--<a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>--}}
                            </div>
                        </div>
                    </div><!-- row -->
                </div><!-- card -->




            </div><!-- col-9 -->


            </div><!-- col-3 -->
        </div><!-- row -->

    </div><!-- br-pagebody -->
--}}
</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


<script>
    $(function(){
        'use strict'

        // FOR DEMO ONLY
        // menu collapsed by default during first page load or refresh with screen
        // having a size between 992px and 1299px. This is intended on this page only
        // for better viewing of widgets demo.
        $(window).resize(function(){
            minimizeMenu();
        });

        minimizeMenu();

        function minimizeMenu() {
            if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
                // show only the icons and hide left menu label by default
                $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
                $('body').addClass('collapsed-menu');
                $('.show-sub + .br-menu-sub').slideUp();
            } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
                $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
                $('body').removeClass('collapsed-menu');
                $('.show-sub + .br-menu-sub').slideDown();
            }
        }
    });
</script>


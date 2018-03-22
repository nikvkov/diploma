<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    /*Статистика создания документов*/
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Пользователь", "Количество документов", { role: "style" } ],

            @foreach($users->all() as $user)
                ["{{$user->name}}", {{count($user->files)}}, "gold"],
            @endforeach
            // ["Copper", 8.94, "#b87333"],
            // ["Silver", 10.49, "silver"],
            // ["Gold", 19.30, "gold"],
            // ["Platinum", 21.45, "color: #e5e4e2"]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" },
            2]);

        var options = {
            title: "Статистика создания документов по пользователям",
            width: 700,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("datafiles_stat"));
        chart.draw(view, options);

        /*Статистика создания отчетов*/
        data = google.visualization.arrayToDataTable([
            ["Пользователь", "Количество отчетов", { role: "style" } ],

                @foreach($users->all() as $user)
            ["{{$user->name}}", {{count($user->orders)}}, "green"],
            @endforeach
            // ["Copper", 8.94, "#b87333"],
            // ["Silver", 10.49, "silver"],
            // ["Gold", 19.30, "gold"],
            // ["Platinum", 21.45, "color: #e5e4e2"]
        ]);

        view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" },
            2]);

        options = {
            title: "Статистика создания отчетов по пользователям",
            width: 700,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
        };
        chart = new google.visualization.ColumnChart(document.getElementById("orders_stat"));
        chart.draw(view, options);

        /*Статистика создания сообщений*/
        data = google.visualization.arrayToDataTable([
            ["Пользователь", "Количество сообщений", { role: "style" } ],

                @foreach($users->all() as $user)
            ["{{$user->name}}", {{count($user->messages)}}, "blue"],
            @endforeach
            // ["Copper", 8.94, "#b87333"],
            // ["Silver", 10.49, "silver"],
            // ["Gold", 19.30, "gold"],
            // ["Platinum", 21.45, "color: #e5e4e2"]
        ]);

        view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" },
            2]);

        options = {
            title: "Статистика отправки сообщений по пользователям",
            width: 700,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
        };
        chart = new google.visualization.ColumnChart(document.getElementById("messages_stat"));
        chart.draw(view, options);

        /*Статистика рабочего времени*/
        data = google.visualization.arrayToDataTable([
            ['Пользователь', 'Время работы, с'],
            @foreach($users->all() as $user)
            ["{{$user->name}}", {{$datafile->getWorkTime($user->id)}}],
            @endforeach

           // ['German',  5.85],

        ]);

        options = {
            legend: 'right',
            pieSliceText: 'label',
            title: 'Статистика рабочего времени',
            pieStartAngle: 100,
        };

        chart = new google.visualization.PieChart(document.getElementById('worktime_stat'));
        chart.draw(data, options);

    }
</script>

<!-- Modal -->
<div  class="modal fade" id="modalUserStat"  role="dialog"  aria-hidden="true">
    <div style="max-width: 1000px"  class="modal-dialog" >
        <div  class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="myModalLabel">Просмотр</h4>
            </div>
            <div style="width: 950px" id = "modal-body_user_stat" class="modal-body_user_stat">

            </div>
            <div class="modal-footer">
                <center>
                    <button  type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </center>
            </div>
        </div>
    </div>
</div>

<style href="/css/custom-admin.css"></style>
<div class="pd-30">
    <div class="row row-sm mg-t-20">
        <div class="col-12">
            <div class="card bd-0 shadow-base pd-30 mg-t-20">

                {{--<div class="d-flex align-items-center justify-content-between mg-b-30">--}}
                    {{--<div>--}}
                        <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Отправленные сообщения</h6>
                        <p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> вся статистика</p><br/>
                <div style="display: none" id="order_data_user" class="col-sm-8 col-md-8">
                    <div class="alert-message alert-message-notice">
                        <h4>Статус готовности отчета</h4>
                        <p id = "order_data_user_content">Ошибка отправки</p>
                    </div>
                </div>
                        <table style="margin-top: 25px" class="table table-bordered">
                            <thead id = "t_head" class="thead-colored thead-primary" >
                            <tr>
                            <th class=" text text-md-center"><input onclick="checkAllUsers()" checked="checked" id = "checkAllUsers" type="checkbox" ></th>
                            <th class="text text-md-center">Имя</th>
                            <th class="text text-md-center">Email</th>
                            <th class=" text text-md-center">Телефон</th>
                            <th class=" text text-md-center">Skype</th>
                            <th class=" text text-md-center">Страна</th>
                            <th class=" text text-md-center">Город</th>
                            <th class=" text text-md-center">Дата рождения</th>
                            <th class=" text text-md-center">Дата регистрации</th>
                            <th class=" text text-md-center">Количество файлов</th>
                            <th class=" text text-md-center">Количество отчетов</th>
                            <th class=" text text-md-center">Количество сообщений</th>
                            <th><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="statisticBySelectUsers()">Статистика</button></th>
                            <th><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="orderBySelectUsers()">Отчет</button></th>
                            </tr>
                            </thead>
                            <tbody id = "containerUsers">
                            @foreach($users->all() as $user)
                            <tr class ="t_row">
                                <td scope="row" class="text text-md-center"><input checked="checked" id = "user{{$user->id}}" type="checkbox" value ="{{$user->id}}"></td>
                                <td class="text text-md-center"><label for = "user{{$user->id}}">{{$user->name}}</label></td>
                                <td class="text text-md-center">{{$user->email}}</td>
                                <td class="text text-md-center">@if(isset($user->person)) {{$user->person->tel}}  @endif</td>
                                <td class="text text-md-center">@if(isset($user->person)){{$user->person->skype}}  @endif</td>
                                <td class="text text-md-center">@if(isset($user->person)){{$user->person->country}}  @endif</td>
                                <td class="text text-md-center">@if(isset($user->person)){{$user->person->city}}  @endif</td>
                                <td class="text text-md-center">@if(isset($user->person)){{(new DateTime($user->person->birth_date))->format('F j, Y')}}  @endif</td>
                                <td class="text text-md-center">@if(isset($user->person)){{(new DateTime($user->created_at))->format('F j, Y')}}  @endif
                                <td class="text text-md-center">{{ count($user->files) }}</td>
                                <td class="text text-md-center">{{ count($user->orders) }}</td>
                                <td class="text text-md-center">{{ count($user->messages) }}</td>
                                <td><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="statisticByUser({{$user->id}})">Статистика</button></td>
                                <td><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="orderByUser({{$user->id}})">Отчет</button></td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    {{--</div>--}}


                {{--</div>--}}

            </div>
        </div>
        <div class="col-6">
            <div class="card bd-0 shadow-base pd-30 mg-t-20">

                {{--<div class="d-flex align-items-center justify-content-between mg-b-30">--}}
                    {{--<div>--}}
                        {{--<h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Отправленные сообщения</h6>--}}
                        {{--<p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> вся статистика</p><br/>--}}
                        <div id="datafiles_stat" class="br-graf br-graf-2 ht-700 ht-sm-400"></div>
                        <div class="mg-t-20 tx-13">
                            <button onclick="createOrderByFiles()" class="tx-gray-600 hover-info">Создать отчет</button>
                            {{--<a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>--}}
                        </div>
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="col-6">
            <div class="card bd-0 shadow-base pd-30 mg-t-20">

                {{--<div class="d-flex align-items-center justify-content-between mg-b-30">--}}
                    {{--<div>--}}
                        {{--<h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Отправленные сообщения</h6>--}}
                        {{--<p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> вся статистика</p><br/>--}}
                        <div id="orders_stat" class="br-graf br-graf-2 ht-800 ht-sm-400"></div>
                        <div class="mg-t-20 tx-13">
                            <button onclick="createOrderByUserOrders()" class="tx-gray-600 hover-info">Создать отчет</button>
                            {{--<a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>--}}
                        </div>
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="col-6">
            <div class="card bd-0 shadow-base pd-30 mg-t-20">

                {{--<div class="d-flex align-items-center justify-content-between mg-b-30">--}}
                {{--<div>--}}
                {{--<h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Отправленные сообщения</h6>--}}
                {{--<p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> вся статистика</p><br/>--}}
                <div id="messages_stat" class="br-graf br-graf-2 ht-700 ht-sm-400"></div>
                <div class="mg-t-20 tx-13">
                    <button onclick="createOrderByUserMessages()" class="tx-gray-600 hover-info">Создать отчет</button>
                    {{--<a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>--}}
                </div>
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="col-6">
            <div class="card bd-0 shadow-base pd-30 mg-t-20">

                {{--<div class="d-flex align-items-center justify-content-between mg-b-30">--}}
                {{--<div>--}}
                {{--<h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Отправленные сообщения</h6>--}}
                {{--<p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> вся статистика</p><br/>--}}
                <div id="worktime_stat" class="br-graf br-graf-2 ht-700 ht-sm-400"></div>
                <div class="mg-t-20 tx-13">
                    <button onclick="createOrderByUserCteateTime()" class="tx-gray-600 hover-info">Создать отчет</button>
                    {{--<a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>--}}
                </div>
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>

<style>

    #t_head{
        color: white;
    }

    .read{
        background-color: #CCFFCC;
    }

    .t_row:hover{
        background-color: #00FF33;
        color: black;
        height: 105%;
    }
</style>
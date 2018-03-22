<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

       // Статистика по отчетам
      var  data = google.visualization.arrayToDataTable([
            ['Пользователь', 'Количество сообщений'],
                @foreach($users->all() as $user)
            ['{{$user->name}}',     {{count($user->messages)}}],
            @endforeach
            // ['Work',     11],
            // ['Eat',      2],
            // ['Commute',  2],
            // ['Watch TV', 2],
            // ['Sleep',    7]
        ]);

       var options = {
            title: 'Статистика по созданию сообщений',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('messages_stat'));
        chart.draw(data, options);

        /****Статистика по дням***/
        data = google.visualization.arrayToDataTable([
            ['Дата', 'Сообщения'],
                @foreach($messages->getDataForDays() as $row)
                {{--[{{(new DateTime($row->day))->format('F j, Y')}}, {{$row->num}}],--}}
            ['{{(new DateTime($row->day))->format('F j, Y')}}', {{$row->num}}],
            @endforeach

            // ['2004',  1000,      400],
            // ['2005',  1170,      460],
            // ['2006',  660,       1120],
            // ['2007',  1030,      540]
        ]);

        options = {
            title: 'Статистика создания документов',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        chart = new google.visualization.LineChart(document.getElementById('create_messages_stat'));

        chart.draw(data, options);

    }
</script>

<!-- Modal -->
<div  class="modal fade" id="modalMessage"  role="dialog"  aria-hidden="true">
    <div style="max-width: 820px" class="modal-dialog" style="width: 850px; height: 600px">
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
                    <button  type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </center>
            </div>
        </div>
    </div>
</div>

{{--<style href="/css/custom-admin.css"></style>--}}
<div class="pd-30">
    <div class="row row-sm mg-t-20">
        <div class="col-12">
            <div class="card bd-0 shadow-base pd-30 mg-t-20">

                {{--<div class="d-flex align-items-center justify-content-between mg-b-30">--}}
                    {{--<div>--}}
                        <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Отправленные сообщения</h6>
                        <p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> вся статистика</p><br/>
                        <div class="form-group mg-b-0">
                            <button onclick="showMessagesArchive()" style="margin-top: 30px" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">Все</button>

                            <select style="margin-top: 15px" class="form-control" id = "selected_user" >
                            @foreach($users->all() as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                            </select>
                            <button onclick="showByUser()" style="margin-top: 5px" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">Выделить</button>

                        </div>
                        <table style="margin-top: 25px" class="table table-bordered">
                            <thead id = "t_head" class="thead-colored thead-primary" >
                            <tr>
                            <th class=" text text-md-center"><input onclick="checkAllMessages()" checked="checked" id = "checkAllMess" type="checkbox" ></th>
                            <th class="text text-md-center">Название</th>
                            <th class="text text-md-center">Пользователь</th>
                            <th class=" text text-md-center">Отправлено</th>
                            <th><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="deleteAllMessages()">Х (отмеченные)</button></th>
                            </tr>
                            </thead>
                            <tbody id = "containerMessages">
                            @foreach($messages->allByDesc() as $page)
                            <tr onclick="viewMessage({{$page->id}})" class ="t_row @if($page->read) read @endif">
                                <td scope="row" class="text text-md-center"><input checked="checked" id = "mess{{$page->id}}" type="checkbox" value ="{{$page->id}}"></td>
                                <td class="text text-md-center"><label for = "mess{{$page->id}}">{{$page->title}}</label></td>
                                <td class="text text-md-center">{{$page->user->name}}</td>
                                <td class="text text-md-center">{{$page->created_at}}</td>
                                <td><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="deleteMessage({{$page->id}})">X</button></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button onclick="sendNewMessage()" style="margin-top: 5px" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">Написать новое сообщение</button>

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
                        <div id="messages_stat" class="br-graf br-graf-2 ht-800 ht-sm-400"></div>
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
                        <div id="create_messages_stat" class="br-graf br-graf-2 ht-800 ht-sm-400"></div>
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
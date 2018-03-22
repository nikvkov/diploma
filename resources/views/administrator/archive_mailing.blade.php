<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        /****Статистика по дням***/
       var data = google.visualization.arrayToDataTable([
            ['Дата', 'Количество получивших пользователей'],
            @foreach($mailing->getDataForDays() as $row)
            {{--[{{(new DateTime($row->day))->format('F j, Y')}}, {{$row->num}}],--}}
            ['{{(new DateTime($row->day))->format('F j, Y')}}', {{$row->number}}],
            @endforeach

            // ['2004',  1000,      400],
            // ['2005',  1170,      460],
            // ['2006',  660,       1120],
            // ['2007',  1030,      540]
        ]);

       var options = {
            title: 'Статистика рассылки',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

       var chart = new google.visualization.LineChart(document.getElementById('mailing_stat'));

        chart.draw(data, options);

    }
</script>

<!-- Modal -->
<div  class="modal fade" id="modalMailing"  role="dialog"  aria-hidden="true">
    <div style="max-width: 820px" class="modal-dialog" style="width: 850px; height: 600px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="myModalLabel">Просмотр</h4>
            </div>
            <div class="modal-body">
                <iframe height="500px" width="800px" id = "prevMailing" srcdoc="">

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
                        <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Отправленные рассылки</h6>
                        <p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> вся статистика</p><br/>
                        <div class="form-group mg-b-0">
                            <button onclick="showMessagesArchive()" style="margin-top: 30px" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">Все</button>

                            {{--<select style="margin-top: 15px" class="form-control" id = "selected_user" >--}}
                            {{--@foreach($users->all() as $item)--}}
                            {{--<option value="{{$item->id}}">{{$item->name}}</option>--}}
                            {{--@endforeach--}}
                            {{--</select>--}}
                            {{--<button onclick="showByUser()" style="margin-top: 5px" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">Выделить</button>--}}

                        </div>
                <div style="display: none" id="order_mailing" class="col-sm-8 col-md-8">
                    <div class="alert-message alert-message-notice">
                        <h4>Статус готовности отчета</h4>
                        <p id = "order_mailing_content">Ошибка отправки</p>
                    </div>
                </div>


                <table style="margin-top: 25px" class="table table-bordered">
                            <thead id = "t_head" class="thead-colored thead-primary" >
                            <tr>
                            <th class=" text text-md-center"><input onclick="checkAllMailings()" checked="checked" id = "checkAllMailings" type="checkbox" ></th>
                            <th class="text text-md-center">Название</th>
                            <th class="text text-md-center">Количество пользователей</th>
                            <th class=" text text-md-center">Отправлено</th>
                            <th></th>
                            <th><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="deleteAllMessages()">Х (отмеченные)</button></th>
                            <th><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="orderForAllMailing()">Отчет</button></th>
                            </tr>
                            </thead>
                            <tbody id = "containerMailings">
                            @foreach($mailing->allByDesc() as $item)
                            <tr  class ="t_row">
                                <td scope="row" class="text text-md-center"><input checked="checked" id = "mail{{$item->id}}" type="checkbox" value ="{{$item->id}}"></td>
                                <td onclick="viewMailing({{$item->id}})" class="text text-md-center"><label for = "mail{{$item->id}}">{{$item->title}}</label></td>
                                <td class="text text-md-center">{{$item->num}}</td>
                                <td class="text text-md-center">{{$item->created_at}}</td>
                                <td><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="viewMailing({{$item->id}})">Просмотр</button></td>
                                <td><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="deleteMailing({{$item->id}})">X</button></td>
                                <td><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="orderMailing({{$item->id}})">Отчет</button></td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button onclick="newMailing()" style="margin-top: 5px" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">Новая рассылка</button>

                    {{--</div>--}}


                {{--</div>--}}

            </div>
        </div>
        <div class="col-12">
            <div class="card bd-0 shadow-base pd-30 mg-t-20">

                {{--<div class="d-flex align-items-center justify-content-between mg-b-30">--}}
                    {{--<div>--}}
                        {{--<h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Отправленные сообщения</h6>--}}
                        {{--<p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> вся статистика</p><br/>--}}
                        <div id="mailing_stat" class="br-graf br-graf-2 ht-800 ht-sm-400"></div>
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
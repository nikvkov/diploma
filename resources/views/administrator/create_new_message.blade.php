{{--<script type="text/javascript">--}}
    {{--google.charts.load('current', {'packages':['corechart']});--}}
    {{--google.charts.setOnLoadCallback(drawChart);--}}

    {{--function drawChart() {--}}

       {{--// Статистика по отчетам--}}
      {{--var  data = google.visualization.arrayToDataTable([--}}
            {{--['Пользователь', 'Количество сообщений'],--}}
                {{--@foreach($users->all() as $user)--}}
            {{--['{{$user->name}}',     {{count($user->messages)}}],--}}
            {{--@endforeach--}}
            {{--// ['Work',     11],--}}
            {{--// ['Eat',      2],--}}
            {{--// ['Commute',  2],--}}
            {{--// ['Watch TV', 2],--}}
            {{--// ['Sleep',    7]--}}
        {{--]);--}}

       {{--var options = {--}}
            {{--title: 'Статистика по созданию сообщений',--}}
            {{--pieHole: 0.4,--}}
        {{--};--}}

        {{--var chart = new google.visualization.PieChart(document.getElementById('messages_stat'));--}}
        {{--chart.draw(data, options);--}}

        {{--/****Статистика по дням***/--}}
        {{--data = google.visualization.arrayToDataTable([--}}
            {{--['Дата', 'Сообщения'],--}}
                {{--@foreach($messages->getDataForDays() as $row)--}}
                {{--[{{(new DateTime($row->day))->format('F j, Y')}}, {{$row->num}}],--}}
            {{--['{{(new DateTime($row->day))->format('F j, Y')}}', {{$row->num}}],--}}
            {{--@endforeach--}}

            {{--// ['2004',  1000,      400],--}}
            {{--// ['2005',  1170,      460],--}}
            {{--// ['2006',  660,       1120],--}}
            {{--// ['2007',  1030,      540]--}}
        {{--]);--}}

        {{--options = {--}}
            {{--title: 'Статистика создания документов',--}}
            {{--curveType: 'function',--}}
            {{--legend: { position: 'bottom' }--}}
        {{--};--}}

        {{--chart = new google.visualization.LineChart(document.getElementById('create_messages_stat'));--}}

        {{--chart.draw(data, options);--}}

    {{--}--}}
{{--</script>--}}

<!-- Modal -->

{{--/*Модальное окно*/--}}
<div class="modal fade" id="modalMessageDialog" tabindex="-1" role="dialog">
    <div style="max-width: 800px; width: 750px" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Содержимое сообщения</h4>
                <button class="close" type="button" data-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                {{--<h3>Содержимое модального окна</h3>--}}
                <form style="width: 700px" role="form">
                    <div style="height: 80px" class="form-group">
                        <label class="lead" for="message_title">Заголовок </label>
                        <input style="height: 35px; width: 700px;" type="text" class="form-control" id="message_title" placeholder="Укажите заготовок">
                        <p class="help-block">Значение отображаемое в списке</p>
                    </div>
                    <div class="form-group">
                        <label class="lead" for="message_content">Содержание</label>
                        <textarea style="height: 135px; width: 700px;" class="form-control" id="message_content" placeholder="Содержание"></textarea>
                    </div>
                    <div class="has-warning">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="check-warn" value="is_need_mail">
                                Дублировать сообщение на почту
                            </label>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button>
                <button onclick="sendMessageToUser()" class="btn btn-primary" type="button">Отправить сообщение</button></div>
        </div>
    </div>
</div>


{{--/*************************************************************************/--}}

{{--/****************************Основная разметка****************************/--}}
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

                <div class="d-flex align-items-center justify-content-between mg-b-30">
                    <div>
                        <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Отправить новое сообщение</h6>
                        <p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> создать сообщение</p><br/>

                    {{--</div>--}}
                        <div style="display: none" id="success_message" class="col-sm-8 col-md-8">
                            <div class="alert-message alert-message-success">
                                <h4>Статус отправки</h4>
                                <p>Сообщение отправлено</p>
                            </div>
                        </div>
                        <div style="display: none" id="error_message" class="col-sm-8 col-md-8">
                            <div class="alert-message alert-message-danger">
                                <h4>Статус отправки</h4>
                                <p>Ошибка отправки</p>
                            </div>
                        </div>
                        <div style="display: none" id="order_message" class="col-sm-8 col-md-8">
                            <div class="alert-message alert-message-notice">
                                <h4>Статус готовности отчета</h4>
                                <p id = "order_message_content">Ошибка отправки</p>
                            </div>
                        </div>

                    <div class="pd-x-30 pd-b-30">
                        <table class="table text text-center table-bordered">
                            <thead id ="t_head">
                            <tr class="active">
                                <td><input onclick="checkUsersForData()" type="checkbox" checked = "checked" id = "selected_users"></td>
                                <td>Пользователь</td>
                                <td>Все сообщения</td>
                                <td>Прочитанные сообщения</td>
                                <td>Не прочитанные сообщения</td>
                                <td>
                                    <button onclick="sendNewMessageToUser(0)" style="margin-top: 5px" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">Написать новое сообщение</button>
                                </td>
                                <td>
                                    <button onclick="orderForMessageToSelectedUser()" style="margin-top: 5px" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">Отчет</button>
                                </td>
                            </tr>
                            </thead>
                            <tbody id="t_body_users_messages">
                            @foreach($users->all() as $user)
                                <tr>
                                    <td><input type="checkbox" checked = "checked" value="{{$user->id}}" id = "user{{$user->id}}"></td>
                                    <td><label for = "user{{$user->id}}">{{$user->name}}</label></td>
                                    <td>{{count($messages->getMessagesByUser($user->id))}}</td>
                                    <td>{{count($messages->getReadMessagesByUser($user->id))}}</td>
                                    <td>{{count($messages->getNoReadMessagesByUser($user->id))}}</td>
                                    <td>
                                        <button onclick="sendNewMessageToUser({{$user->id}})" style="margin-top: 5px" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">Написать новое сообщение</button>
                                    </td>
                                    <td>
                                        <button onclick="orderForMessageToUser({{$user->id}})" style="margin-top: 5px" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">Отчет</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
</div>

<style>

    #t_head{
        color: white;
        background-color: #003333;
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
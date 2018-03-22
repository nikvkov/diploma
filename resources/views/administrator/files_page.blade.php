<script type="text/javascript">
   /***Статистика создания файлов***/
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);

   function drawChart() {
       var data = google.visualization.arrayToDataTable([
           ['Дата', 'Количество созданных файлов'],
           @foreach($datafile->getDataForDays() as $file)
            ['{{(new DateTime($file->day))->format('F j, Y')}}', {{$file->num}}],
           @endforeach
           // ['2004',  1000,      400],
           // ['2005',  1170,      460],
           // ['2006',  660,       1120],
           // ['2007',  1030,      540]
       ]);

       var options = {
           title: 'Статистика создания файлов',
           curveType: 'function',
           legend: { position: 'bottom' },
           colors:['red','#004411']
       };

       var chart = new google.visualization.LineChart(document.getElementById('create_files_stat'));

       chart.draw(data, options);

       /***СТАТИСТИКА СОЗДАНИЯ ПО ПОЛЬЗОВАТЕЛЯМ***/
       data = google.visualization.arrayToDataTable([
           ['Пользователь', 'Количество созданных файлов'],

           @foreach($user->all() as $item)
                ['{{$item->name}}',    {{count($item->files)}}],
           @endforeach
           // ['Work',     11],
           // ['Eat',      2],
           // ['Commute',  2],
           // ['Watch TV', 2],
           // ['Sleep',    7]
       ]);

       options = {
           title: 'Статистика создания по пользователям'
       };

       chart = new google.visualization.PieChart(document.getElementById('create_by_user_stat'));

       chart.draw(data, options);

       /***СТАТИСТИКА ПО РАЗМЕРУ ФАЙЛОВ***/
       data = google.visualization.arrayToDataTable([
           ["Пользователь", "РАзмер созданных файлов, байт", { role: "style" } ],

           @foreach($user->all() as $item)
           ["{{$item->name}}", {{$item->getFilesSize()}}, "green"],
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
           title: "Статистика размера созданных файлов по пользователям",
           width: 700,
           height: 400,
           bar: {groupWidth: "95%"},
           legend: { position: "none" },
       };
       chart = new google.visualization.ColumnChart(document.getElementById("files_size_stat"));
       chart.draw(view, options);

   }

</script>

<!-- Modal -->
<div  class="modal fade" id="modalFilesStat"  role="dialog"  aria-hidden="true">
    <div style="max-width: 1000px"  class="modal-dialog" >
        <div  class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" id="myModalLabel">Просмотр</h4>
            </div>
            <div style="width: 950px" id = "modal-body_file_stat" class="modal-body_user_stat">

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
                        <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Созданные файлы</h6>
                        <p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> вся статистика</p><br/>
                <div style="display: none" id="order_data_file" class="col-sm-8 col-md-8">
                    <div class="alert-message alert-message-notice">
                        <h4>Статус готовности отчета</h4>
                        <p id = "order_data_file_content">Ошибка отправки</p>
                    </div>
                </div>
                        <table style="margin-top: 25px" class="table table-bordered">
                            <thead id = "t_head" class="thead-colored thead-primary" >
                            <tr>
                            <th class=" text text-md-center"><input onclick="checkAllFiles()" checked="checked" id = "checkAllFiles" type="checkbox" ></th>
                            <th class="text text-md-center">Файл</th>
                            <th class="text text-md-center">Размер</th>
                            <th class=" text text-md-center">Время создания</th>
                            <th class=" text text-md-center">Проект</th>
                            <th class=" text text-md-center">Сервис</th>
                            <th class=" text text-md-center">Дата создания</th>
                            <th class="text text-md-center">Пользователь</th>
                            <th><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="statisticExistFiles()">Отчет</button></th>
                            </tr>
                            </thead>
                            <tbody id = "containerFiles">
                            @foreach($datafile->getAllFilesForAdmin() as $file)
                            <tr class ="t_row">
                                <td scope="row" class="text text-md-center"><input checked="checked" id = "file{{$file->id}}" type="checkbox" value ="{{$file->id}}"></td>
                                <td class="text text-md-center"><label for = "file{{$file->id}}">{{$file->filename}}</label></td>
                                <td class="text text-md-center">{{$file->size}}</td>
                                <td class="text text-md-center">{{$file->create_time}}</td>
                                <td class="text text-md-center">{{$file->project->title}}</td>
                                <td class="text text-md-center">{{$file->service->title}}</td>
                                <td class="text text-md-center">{{(new DateTime($file->created_at))->format('F j, Y')}}</td>
                                <td class="text text-md-center">{{$user->getById($file->user_id)->name}}</td>
                                <td><a href="/{{$file->directory}}/{{$file->filename}}" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" >Скачать</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

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
                        <div id="create_files_stat" class="br-graf br-graf-2 ht-700 ht-sm-400"></div>
                        {{--<div class="mg-t-20 tx-13">--}}
                            {{--<button onclick="createOrderByFiles()" class="tx-gray-600 hover-info">Создать отчет</button>--}}
                            {{--<a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>--}}
                        {{--</div>--}}
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
                        <div id="create_by_user_stat" class="br-graf br-graf-2 ht-800 ht-sm-400"></div>
                        {{--<div class="mg-t-20 tx-13">--}}
                            {{--<button onclick="createOrderByUserOrders()" class="tx-gray-600 hover-info">Создать отчет</button>--}}
                            {{--<a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>--}}
                        {{--</div>--}}
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
                <div id="files_size_stat" class="br-graf br-graf-2 ht-700 ht-sm-400"></div>
                {{--<div class="mg-t-20 tx-13">--}}
                    {{--<button onclick="createOrderByUserMessages()" class="tx-gray-600 hover-info">Создать отчет</button>--}}
                    {{--<a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>--}}
                {{--</div>--}}
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
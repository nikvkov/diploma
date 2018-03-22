{{--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>--}}
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Дата', 'Количество созданных файлов'],
             @foreach($files as $file)
            ['{{(new DateTime($file->day))->format('F j, Y')}}', {{$file->num}}],
             @endforeach
            // ['2004',  1000,      400],
            // ['2005',  1170,      460],
            // ['2006',  660,       1120],
            // ['2007',  1030,      540]
        ]);

        var options = {
            title: 'Статистика составления файлов',
            curveType: 'function',
            legend: { position: 'bottom' },
            colors:['red','#004411']
        };

        var chart = new google.visualization.LineChart(document.getElementById('stat_files'));

        chart.draw(data, options);

        /*ОТЧЕТЫ*/
        data = google.visualization.arrayToDataTable([
            ['Дата', 'Количество созданных отчетов'],
                @foreach($orders as $file)
            ['{{(new DateTime($file->day))->format('F j, Y')}}', {{$file->num}}],
            @endforeach
            // ['2004',  1000,      400],
            // ['2005',  1170,      460],
            // ['2006',  660,       1120],
            // ['2007',  1030,      540]
        ]);

        options = {
            title: 'Статистика составления отчетов',
            curveType: 'function',
            legend: { position: 'bottom' },
            colors:['green','#003300']
        };

        chart = new google.visualization.LineChart(document.getElementById('stat_orders'));

        chart.draw(data, options);

        /**СООБЩЕНИЯ**/
        data = google.visualization.arrayToDataTable([
            ['Дата', 'Количество полученных сообщений'],
                @foreach($messages as $file)
            ['{{(new DateTime($file->day))->format('F j, Y')}}', {{$file->num}}],
            @endforeach
            // ['2004',  1000,      400],
            // ['2005',  1170,      460],
            // ['2006',  660,       1120],
            // ['2007',  1030,      540]
        ]);

        options = {
            title: 'Статистика получения сообщения',
            curveType: 'function',
            legend: { position: 'bottom' },
            colors:['blue','#006699']
        };

        chart = new google.visualization.LineChart(document.getElementById('stat_messages'));

        chart.draw(data, options);

    }
</script>


<div class="row">
    <div class="col-12">
        <div class="card bd-0 shadow-base pd-30 mg-t-20">

            {{--<div class="d-flex align-items-center justify-content-between mg-b-30">--}}
            {{--<div>--}}
            {{--<h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Отправленные сообщения</h6>--}}
            {{--<p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> вся статистика</p><br/>--}}
            <div id="stat_files" class="br-graf br-graf-2 ht-300 ht-sm-300"></div>
            {{--<div class="mg-t-20 tx-13">--}}
                {{--<button onclick="createOrderByUserMessages()" class="tx-gray-600 hover-info">Создать отчет</button>--}}
                {{--<a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card bd-0 shadow-base pd-30 mg-t-20">

            {{--<div class="d-flex align-items-center justify-content-between mg-b-30">--}}
            {{--<div>--}}
            {{--<h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Отправленные сообщения</h6>--}}
            {{--<p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> вся статистика</p><br/>--}}
            <div id="stat_orders" class="br-graf br-graf-2 ht-300 ht-sm-300"></div>
            {{--<div class="mg-t-20 tx-13">--}}
            {{--<button onclick="createOrderByUserMessages()" class="tx-gray-600 hover-info">Создать отчет</button>--}}
            {{--<a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card bd-0 shadow-base pd-30 mg-t-20">

            {{--<div class="d-flex align-items-center justify-content-between mg-b-30">--}}
            {{--<div>--}}
            {{--<h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Отправленные сообщения</h6>--}}
            {{--<p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> вся статистика</p><br/>--}}
            <div id="stat_messages" class="br-graf br-graf-2 ht-300 ht-sm-300"></div>
            {{--<div class="mg-t-20 tx-13">--}}
            {{--<button onclick="createOrderByUserMessages()" class="tx-gray-600 hover-info">Создать отчет</button>--}}
            {{--<a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Print Report</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
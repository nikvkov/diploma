<div class="row">
    <div class="col-md-9 cta-button">
        <a class="btn btn-lg btn-block btn-info" href="/{{$filename}}">Скачать файл с результатом проверки</a>
    </div>
</div>
<div class="row">
    <div class="col-md-9 cta-contents">
        <h1 class="cta-title">Результат проверки сайта</h1>
        <div class="cta-desc">
            <div class="wrapper">
                <table id="acrylic" class="table table-bordered">
                    <thead >
                    <tr class="text-capitalize">
                        <th class="text-center">№</th>
                        <th class="text-center">Ссылка</th>
                        <th class="text-center">Тип контента</th>
                        <th class="text-center">Соединение</th>
                        <th class="text-center">Размер контента</th>
                        {{--<th class="text-center">Vary</th>--}}
                        {{--<th class="text-center">Pragma</th>--}}
                        <th class="text-center">Cache-Control</th>
                        <th class="text-center">Expires</th>
                        <th class="text-center">Set-Cookie</th>
                        {{--<th class="text-center">X-Powered-By</th>--}}
                        <th class="text-center">Server</th>
                        <th class="text-center">Date</th>
                        {{--<th class="text-center">responce_code</th>--}}
                        <th class="text-center">server_responce</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataFromFile as $item)

                        <tr @if(strpos($item["responce_code"],'200')!==false) class="text-success" @elseif(strpos($item["responce_code"],'30')!==false) class="text-warning" @else class="text-danger" @endif>
                            <td class="lead" >{{$item["num"]}}</td>
                            <td class="font-weight-bold">{{$item["link"]}}</td>
                            <td class="font-weight-bold">{{$item["Content-Type"]}}</td>
                            <td class="font-weight-bold">{{$item["Connection"]}}</td>
                            <td class="font-weight-bold">{{$item["Content-Length"]}}</td>
                            {{--<td class="font-weight-bold">{{$item["Vary"]}}</td>--}}
                            {{--<td class="font-weight-bold">{{$item["Pragma"]}}</td>--}}
                            <td class="font-weight-bold">{{$item["Cache-Control"]}}</td>
                            <td class="font-weight-bold">{{$item["Expires"]}}</td>
                            <td class="font-weight-bold">{{$item["Set-Cookie"]}}</td>
                            {{--<td class="font-weight-bold">{{$item["X-Powered-By"]}}</td>--}}
                            <td class="font-weight-bold">{{$item["Server"]}}</td>
                            <td class="font-weight-bold">{{$item["Date"]}}</td>
                            {{--<td class="font-weight-bold">{{$item["responce_code"]}}</td>--}}
                            <td class="font-weight-bold">{{$item["server_responce"]}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9 cta-button">
        <a class="btn btn-lg btn-block btn-info" href="/{{$filename}}">Скачать файл с результатом проверки</a>
    </div>
</div>
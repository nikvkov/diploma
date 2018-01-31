<div class="row">
    <div class="col-md-9 cta-button">
        <a class="btn btn-lg btn-block btn-info" href="/{{$file}}">Скачать файл с результатом проверки</a>
    </div>
</div>
<div class="row">
    <div class="col-md-9 cta-contents">
        <h1 class="cta-title">Результат проверки ссылок</h1>
        <div class="cta-desc">
            <div class="wrapper">
                <table id="acrylic" class="table table-bordered">
                    <thead >
                    <tr class="text-capitalize">
                        <th class="text-center">№</th>
                        <th class="text-center">Ссылка</th>
                        <th class="text-center">Ответ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $item)

                        <tr @if(strpos($item["http_code"],'200')!==false) class="text-success" @elseif(strpos($item["http_code"],'30')!==false) class="text-warning" @else class="text-danger" @endif>
                            <td class="lead" >{{$item["pos"]}}</td>
                            <td class="font-weight-bold">{{$item["uri"]}}</td>
                            <td class="font-weight-bold">{{$item["http_code"]}}</td>
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
        <a class="btn btn-lg btn-block btn-info" href="/{{$file}}">Скачать файл с результатом проверки</a>
    </div>
</div>
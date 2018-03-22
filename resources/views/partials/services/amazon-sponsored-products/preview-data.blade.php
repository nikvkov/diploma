
<div class="row">

    <div class="col-md-10 cta-button">
        <button onclick="createAmazonAdsFile()" class="btn btn-lg btn-block btn-info">Сформировать файл</button>
    </div>
</div>


<div class="row">
    <div class="col-md-9 cta-contents">
        {{--<h1 class="cta-title">Выберите товары для включения в файл</h1>--}}
        <div class="cta-desc">
            <div class="wrapper">
                <table class='table table-hover table-bordered table-condensed'>
                    <thead class="thead-inverse">
                    @foreach($header as $item)
                        <th class="text text-center">{{$item}}</th>
                    @endforeach
                    </thead>
                    <tbody >
                        @foreach($data as $row)
                            <tr>
                                @foreach($row as $item)
                                    <td>{{$item}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-md-10 cta-button">
        <button onclick="createAmazonAdsFile()" class="btn btn-lg btn-block btn-info">Сформировать файл</button>
    </div>
</div>
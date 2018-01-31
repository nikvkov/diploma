
<div class="row">
    <div class="col-md-9 cta-contents">
        <h1 class="cta-title">Результат проверки сайта</h1>
        <div class="cta-desc">
            <div class="wrapper">
                <div class="col-md-6 cta-button">
                    <input type="button" onclick="showDataInFile('{{$filename}}')" class="btn btn-lg btn-block btn-info" value="Показать результат"/>
                </div>
                <div class="col-md-6 cta-button">
                    <a class="btn btn-lg btn-block btn-info" href="/{{$filename}}">Скачать файл с результатом проверки</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<div class="row">--}}
    {{--<div class="col-md-9 cta-button">--}}
        {{--<a class="btn btn-lg btn-block btn-info" href="/{{$file}}">Скачать файл с результатом проверки</a>--}}
    {{--</div>--}}
{{--</div>--}}
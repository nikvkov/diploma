<div class = "row">
    <div class = "col-md-12">
        <hr>
    </div>
</div>
<div class="bs-calltoaction bs-calltoaction-info">
    <div class="row">
        <div class="col-md-9 cta-contents">
            <h1 class="cta-title">Задайте параметры для проверки</h1>
            <div class="cta-desc">
                <form role="form">
                    <div class="form-check">
                        <div class="form-group">
                            <label><span class="label-text">Адрес сайта</span></label>

                            <input id="uri-for-check" class="form-control" type="url" placeholder="Укажите адрес сайта" />
                        </div>
                    </div>
                    <div class="form-check">
                        <label>
                            <input id="is_check_images" type="checkbox" name="check" > <span class="label-text">Проверка изображений</span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label>
                            <input id="is_check_mining" type="checkbox" name="check"> <span class="label-text">Проверить на майнинг</span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label>
                            <input onchange="showEmailField()" id="is_need_email" type="checkbox" name="is_need_email" > <span class="label-text">Направить сообщение по окончании проверки?</span>
                        </label>
                    </div>
                    <div id="showMailField" style="display: none" class="form-check">
                        <div class="form-group">
                            <input name="need_email" id="need_email" class="form-control" type="email" placeholder="Укажите email" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3 cta-button">
            <input onclick="startCheckSite()" type="button" class="btn btn-lg btn-block btn-info" value="Начать проверку" />
            <input onclick="showAllFiles()" type="button" class="btn btn-lg btn-block btn-info" value="Ранее созданные файлы" />

        </div>
    </div>
    {{--<div class="row">--}}
        {{--<div class="col-md-12 cta-contents">--}}
            {{--<form role="form" class="form-inline">--}}
                {{--<div class="form-group">--}}
                    {{--<input id="is_need_email" name="is_need_email" type="checkbox"  class="form-control" />--}}
                    {{--<label for="name">Отправить сообщение после завершения проверки?</label>--}}

                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-12 cta-contents">--}}
            {{--<form role="form" class="form-inline">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="email">E-mail</label>--}}
                    {{--<input name="email" type="email" class="form-control" placeholder="E-mail"/>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>

<div id="loader" class="bs-calltoaction bs-calltoaction-info">
    <div class="row">
        <div class="col-md-2 cta-contents">
            <img style="width: 100px" src="/uploads/progressbar.gif" />
        </div>
        <div class="col-md-5 cta-contents">
            <h3 class="cta-title">Подождите, идет обработка...</h3>
        </div>
        <div class="col-md-5 cta-contents">
            <h3 id="timer" class="cta-title"></h3>
        </div>
    </div>
</div>

<div id="get-all-links-step-2" class="bs-calltoaction bs-calltoaction-info">

</div>
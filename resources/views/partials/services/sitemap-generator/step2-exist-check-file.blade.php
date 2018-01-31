<div class="row">
    <div class="col-md-9 cta-contents">
        <h1 class="cta-title">Шаг 2 : Выберите ранее созданный файл</h1>
        <div class="cta-desc">
            <form role='form' class='form-inline'><div class="form-check"><div class='form-group'>
                <select  class='form-control input-lg selectChange' id="selectedExistFile">
                @foreach($files as $file)
                    <option value="{{$file}}">{{$file}}</option>
                @endforeach
                </select>
            </div></div></form>
        </div>
    </div>
    <div class="col-md-3 cta-button">
        <input id="bt_start_check_area" onclick="step3FromExistFile()" type="button" class="btn btn-lg btn-block btn-info" value="Далее" />
    </div>
</div>
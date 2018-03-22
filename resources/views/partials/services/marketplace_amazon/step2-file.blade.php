<div class="row">
    <form name="uploader" enctype="multipart/form-data" method="POST">
        <div class="col-md-9 cta-contents">
            <h1 class="cta-title">Шаг 2 : Загрузите файл экспорта</h1>
            <div class="cta-desc">
                <div class="control-group">
                    <div class="controls clearfix">
                        <span class="btn btn-success btn-file">

                            <i class="icon-plus"></i> <span class="text">Выберите файл для обработки</span>
                            <input name="userfile" type="file" />

                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 cta-button">
            <!--        <input  type="button" class="btn btn-lg btn-block btn-info" value="Начать проверку" />-->
            <button type="submit" name="submit" class="btn btn-lg btn-block btn-info" >Показать данные</button>
        </div>




    </form>
</div>

<script>
    $("form[name='uploader']").submit(function(event) {
        event.preventDefault();    // запрещаем автоматическую отправку данных
        var formData = new FormData($(this)[0]);

        //  event.stopPropagation(); // остановка всех текущих JS событий

        ajaxLoadFilesMA(formData);
    });
</script>
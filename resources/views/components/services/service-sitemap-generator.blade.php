<div class = "row">
    <div class = "col-md-12">
        <hr>
    </div>
</div>
<div class="bs-calltoaction bs-calltoaction-info">
    <div class="row">
        <div class="col-md-9 cta-contents">
            <h1 class="cta-title">Шаг 1 : Выберите источник ссылок для карты сайта</h1>
            <div class="cta-desc">
                <form>
                    <div class="form-check">
                        <label class="toggle">
                            <input onchange="changeStep2Sitemap()" type="radio" name="radio_sitemap_step_2" value="from_area" checked> <span class="label-text">Вставить текст</span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="toggle">
                            <input onchange="changeStep2Sitemap()" type="radio" name="radio_sitemap_step_2" value="from_file"> <span class="label-text">Из файла</span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="toggle">
                            <input onchange="changeStep2Sitemap()" type="radio" name="radio_sitemap_step_2" value="show_check_site_files"> <span class="label-text">Ранее созданные файлы проверки сайта</span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="toggle">
                            <input onchange="changeStep2Sitemap()" type="radio" name="radio_sitemap_step_2" value="show_all_files"> <span class="label-text">Ранее созданные карты сайта</span>
                        </label>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-md-3 cta-button">
            <input onclick="sitemapStep2()" type="button" class="btn btn-lg btn-block btn-info" value="Дальше" />
        </div>
    </div>
</div>
<div id="sitemap-step-2" class="bs-calltoaction bs-calltoaction-info">

</div>
<div id="loader" class="bs-calltoaction bs-calltoaction-info">
    <div class="row">
        <div class="col-md-3 cta-contents">
            <img style="width: 100px" src="/uploads/progressbar.gif" />
        </div>
        <div class="col-md-9 cta-contents">
            <h3 class="cta-title">Подождите, идет обработка...</h3>
        </div>
    </div>
</div>

<div id="sitemap-step-3" class="bs-calltoaction bs-calltoaction-info">

</div>

<div id="sitemap-step-4" class="bs-calltoaction bs-calltoaction-info">

</div>




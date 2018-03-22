<div class = "row">
    <div class = "col-md-12">
        <hr>
    </div>
</div>
<div class="bs-calltoaction bs-calltoaction-info">
    <div class="row">
        <div class="col-md-9 cta-contents">
            <h1 class="cta-title">Шаг 1 : Выберите источник ссылок</h1>
            <div class="cta-desc">
                <form><table style="font-size: 30px" class="table">
                        <div class="form-check">
                        <label class="toggle">
                                <tr><td> <span class="label-text">Выберите оригинальный язык</span></td>
                           <td> <select class="text text-center"  id = "amazon_original_lang">
                                <option  value="ru">Русский</option>
                                <option  value="de">Немецкий</option>
                                <option value="en">Английский</option>
                                <option value="fr">Французский</option>
                                <option value="es">Испанский</option>
                                <option value="it">Итальянский</option>
                               </select></td></tr>
                        </label>
                        </div>
                    <div class="form-check">
                        <label class="toggle">
                            <tr><td><span class="label-text">Выберите локализацию</span></td>
                            <td><select class="text text-center"  id = "amazon_localization">
                                <option  value="de">Германия</option>
                                <option value="en">Великобритания</option>
                                <option value="fr">Франция</option>
                                <option value="es">Испания</option>
                                <option value="it">Италия</option>
                                </select></td></tr>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="toggle">
                            <tr><td><span class="label-text">Выберите CMS</span></td>
                            <td><select class="text text-center"  id = "amazon_CMS">
                                <option  value="woocommerce">Wordpress Woocommerce</option>
                                <option disabled value="drupal">Drupal</option>
                                <option disabled value="opencart">Opencart</option>
                                </select></td></tr>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="toggle">
                            <tr><td><span class="label-text">Выберите категорию</span></td>
                                <td><select onchange="getTemplateData()" class="text text-center"  id = "amazon_category">
                                    <option selected disabled>Выберите категорию</option>
                                    <option value="PhoneAccessory">Аксессуары для телефонов</option>
                                    <option disabled value="drupal">Ноутбуки</option>
                                </select></td></tr>
                        </label>
                    </div>
                    <div class="form-check">
                        <tr><td colspan="2"><label class="toggle">
                            <input onchange="changeLinkContainerMA()" type="radio" name="marketplace_amazon_show_step_2" value="show_exist_file" checked> <span class="label-text">Показать ранее загруженные файлы</span>
                                </label></td></tr>
                    </div>
                    <div class="form-check">
                        <tr><td colspan="2"><label class="toggle">
                            <input onchange="changeLinkContainerMA()" type="radio" name="marketplace_amazon_show_step_2" value="show_form_load_file"> <span class="label-text">Загрузить из файла</span>
                        </label></td></tr>
                    </div>
                    {{--<div class="form-check">--}}
                        {{--<label class="toggle">--}}
                            {{--<input onchange="changeLinkContainer()" type="radio" name="bad_links_show_step_2" value="show_all_files"> <span class="label-text">Ранее созданные файлы</span>--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    <div class="form-check">
                        <tr><td colspan="2"><label>
                            <input onchange="showEmailField()" id="is_need_email" type="checkbox" name="is_need_email" > <span class="label-text">Направить сообщение на email по окончании проверки?</span>
                                </label></td></tr>
                    </div>
                    <div class="form-check">
                        <tr id="showMailField" style="display: none" ><td colspan="2"><div class="form-group">
                            <input name="need_email" id="need_email" class="form-control" type="email" placeholder="Укажите email" />
                                </div></td></tr>
                    </div>
                    </table></form>
            </div>
        </div>
        <div class="col-md-3 cta-button">
            <input onclick="MarketplaceAmazonStep2()" type="button" class="btn btn-lg btn-block btn-info" value="Дальше" /><br/>
            <input onclick="showMarketplaceExistFile('amazon')" type="button" class="btn btn-lg btn-block btn-info" value="Показать ранее созданные файлы" />

        </div>
    </div>
</div>
<div style="display: none" id="mpa-template-data" class="bs-calltoaction bs-calltoaction-info">

</div>
<div style="display: none" id="mpa-step-2" class="bs-calltoaction bs-calltoaction-info">

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

<div style="display: none" id="mpa-step-3" class="bs-calltoaction bs-calltoaction-info">

</div>




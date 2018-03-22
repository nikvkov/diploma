<div class = "row">
    <div class = "col-md-12">
        <hr>
    </div>
</div>
<div class="bs-calltoaction bs-calltoaction-info">
    <div class="row">

        <div class="col-md-8 cta-button">
            {{--<input onclick="MarketplaceAmazonStep2()" type="button" class="btn btn-lg btn-block btn-info" value="Дальше" /><br/>--}}
            <input onclick="showGMCExistFile()" type="button" class="btn btn-lg btn-block btn-info" value="Показать ранее созданные файлы" />

        </div>
    </div>
    <div class="row">
        <div class="col-md-10 cta-contents">
            <h1 class="cta-title">Шаг 1 : Выберите источник ссылок</h1>
            <div class="cta-desc">
                <form><table style="font-size: 30px" class="table">
                        {{--<div class="form-check">--}}
                        <label class="toggle">
                                <tr><td> <span class="label-text">Выберите оригинальный язык</span></td>
                           <td> <select class="text text-center"  id = "original_lang">
                                <option  value="ru">Русский</option>
                                <option  value="de">Немецкий</option>
                                <option value="en">Английский</option>
                                <option value="fr">Французский</option>
                                <option value="es">Испанский</option>
                                <option value="it">Итальянский</option>
                               </select></td></tr>
                        </label>
                        {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td><span class="label-text">Выберите локализацию</span></td>
                            <td><select class="text text-center"  id = "localization">
                                <option  value="de">Германия</option>
                                <option value="en">Великобритания</option>
                                <option value="fr">Франция</option>
                                <option value="es">Испания</option>
                                <option value="it">Италия</option>
                                </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td><span class="label-text">Выберите CMS</span></td>
                            <td><select class="text text-center"  id = "cms">
                                <option  value="woocommerce">Wordpress Woocommerce</option>
                                <option disabled value="drupal">Drupal</option>
                                <option disabled value="opencart">Opencart</option>
                                </select></td></tr>
                        </label>
                        <label class="toggle">
                            <tr><td><span class="label-text">Описание товара</span></td>
                                <td>
                                    <textarea style="width: 700px" class="text" id ="google-merchant-description"></textarea>
                                </td></tr>
                        </label>
                        <label class="toggle">
                            <tr><td><span class="label-text">Наличие товара в магазине</span></td>
                                <td><select class="text text-center"  id = "google-merchant-availability">
                                        <option  value="in_stock">В наличии</option>
                                        <option value="out_of_stock">Нет в наличии</option>
                                        <option value="preorder">Предзаказ</option>
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td><span class="label-text">Выберите категорию Google</span></td>
                                <td><select class="text text-center"  id = "google-merchant-google-product-category">
                                    <option value="2353">Аксессуары для телефонов/Сумки и чехлы</option>
                                    <option disabled value="166">Предметы одежды и принадлежности</option>
                                    <option disabled value="2092">Программное обеспечение</option>
                                </select></td></tr>
                        </label>
                        <label class="toggle">
                            <tr><td><span class="label-text">Бренд</span></td>
                                <td>
                                    <input class="text text-center" type="text" value="reboon" id ="google-merchant-brand">
                                </td></tr>
                        </label>
                        <label class="toggle">
                            <tr><td><span class="label-text">Состояние</span></td>
                                <td><select class="text text-center"  id = "google-merchant-condition">
                                        <option value="new">Новый</option>
                                        <option value="refurbished">Восстановленный</option>
                                        <option value="used">Использованый</option>
                                    </select></td></tr>
                        </label>
                        <label class="toggle">
                            <tr><td><span class="label-text">Число товаров в упаковке</span></td>
                                <td>
                                    <input class="text text-center" type="number" min="1" value="1" id ="google-merchant-multipack">
                                </td></tr>
                        </label>
                        <label class="toggle">
                            <tr><td><span class="label-text">Принадлежность товара набору</span></td>
                                <td><select class="text text-center"  id = "google-merchant-is-​bundle">
                                        <option value="yes">Да</option>
                                        <option value="no">Нет</option>
                                    </select></td></tr>
                        </label>
                        <label class="toggle">
                            <tr><td><span class="label-text">Материал</span></td>
                                <td><input class="text text-center" type="text" value="Полимер"  id = "google-merchant-material">
                                     </td></tr>
                        </label>
                        <label class="toggle">
                            <tr><td><span class="label-text">Возрастная группа</span></td>
                                <td><select class="text text-center"  id = "google-merchant-age-group">
                                        <option value="">Укажите возрастную группу</option>
                                        <option value="newborn">До трех месяцев</option>
                                        <option value="infant">От трех месяцев до года</option>
                                        <option value="toddler">От года до пяти лет</option>
                                        <option value="kids">От 5 до 13 лет</option>
                                        <option value="adult">от 13 лет</option>
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <tr><td colspan="2"><label class="toggle">
                            <input onchange="changeLinkContainerGMC()" type="radio" name="merchant_center_show_step_2" value="show_exist_file" checked> <span class="label-text">Показать ранее загруженные файлы</span>
                                </label></td></tr>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <tr><td colspan="2"><label class="toggle">
                            <input onchange="changeLinkContainerGMC()" type="radio" name="merchant_center_show_step_2" value="show_form_load_file"> <span class="label-text">Загрузить из файла</span>
                        </label></td></tr>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        {{--<label class="toggle">--}}
                            {{--<input onchange="changeLinkContainer()" type="radio" name="bad_links_show_step_2" value="show_all_files"> <span class="label-text">Ранее созданные файлы</span>--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <tr><td colspan="2"><label>
                            <input onchange="showEmailField()" id="is_need_email" type="checkbox" name="is_need_email" > <span class="label-text">Направить сообщение на email по окончании проверки?</span>
                                </label></td></tr>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <tr id="showMailField" style="display: none" ><td colspan="2"><div class="form-group">
                            <input name="need_email" id="need_email" class="form-control" type="email" placeholder="Укажите email" />
                                </div></td></tr>
                    {{--</div>--}}
                    </table></form>
            </div>
        </div>
        {{--<div class="col-md-3 cta-button">--}}
            {{--<input onclick="MarketplaceAmazonStep2()" type="button" class="btn btn-lg btn-block btn-info" value="Дальше" /><br/>--}}
            {{--<input onclick="showMarketplaceExistFile('amazon')" type="button" class="btn btn-lg btn-block btn-info" value="Показать ранее созданные файлы" />--}}

        {{--</div>--}}
    </div>
    <div class="row">

        <div class="col-md-10 cta-button">

            <input onclick="MerchantCenterStep2()" type="button" class="btn btn-lg btn-block btn-info" value="Дальше" /><br/><br/>

            <input onclick="showGMCExistFile()" type="button" class="btn btn-lg btn-block btn-info" value="Показать ранее созданные файлы" />

        </div>
    </div>
</div>



{{--<div style="display: none" id="mpa-template-data" class="bs-calltoaction bs-calltoaction-info">--}}

{{--</div>--}}
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
<div style="display: none" id="step-4" class="bs-calltoaction bs-calltoaction-info">

</div>




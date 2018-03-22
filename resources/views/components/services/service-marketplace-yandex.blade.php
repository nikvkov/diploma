<div class = "row">
    <div class = "col-md-12">
        <hr>
    </div>
</div>
<div class="bs-calltoaction bs-calltoaction-info">
    <div class="row">
        <div class="col-md-12 cta-contents">
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
                                <option  value="ru">Россия</option>
                                <option  value="ua">Украина</option>
                                </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td><span class="label-text">Выберите CMS</span></td>
                            <td><select class="text text-center"  id = "cms">
                                <option  value="woocommerce">Wordpress Woocommerce</option>
                                <option value="drupal">Drupal</option>
                                <option value="opencart">Opencart</option>
                                </select></td></tr>
                        </label>
                        {{--<div class="form-check">--}}
                            <tr><td colspan="2"><label>
                                        <input checked  id="available" type="checkbox" name="available" > <span class="label-text">Есть на складе</span>
                                    </label>
                                </td></tr>
                        {{--</div>--}}
                        <tr><td colspan="2"><label>
                                    <input checked  id="delivery" type="checkbox" name="delivery" > <span class="label-text">Доставка</span>
                                </label></td></tr>
                        <tr><td colspan="2"><label>
                                    <input   id="pikup" type="checkbox" name="pickup" > <span class="label-text">Самовывоз</span>
                                </label></td></tr>
                        <tr><td colspan="2"><label>
                                    <input checked  id="store" type="checkbox" name="store" > <span class="label-text">Возможность купить без предзаказа</span>
                                </label></td></tr>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td><span class="label-text">Выберите категорию</span></td>
                                <td><select class="text text-center"  id = "category">

                                    {{--<option value="Все товары/Электроника/Телефоны/Аксессуары для телефонов/Чехлы">Чехлы для телефонов</option>--}}
                                        <option value="Аксессуары для телефонов/Чехлы">Чехлы для телефонов</option>
                                    <option disabled value="Все товары/Электроника/Телефоны/Мобильные телефоны">Мобильные телефоны</option>
                                </select></td></tr>
                        </label>

                        {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Заметки продавца</span></td>
                                <td><textarea style="width: 700px" id="sales_notes">Предоплата не требуется</textarea> </td></tr>
                        </label>
                        <tr><td colspan="2"><label>
                                    <input checked  id="manufacturer_warranty" type="checkbox" name="manufacturer_warranty" > <span class="label-text">Гарантия продавца</span>
                                </label></td></tr>
                        {{--</div>--}}
                        {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td><span class="label-text">Страна-производитель</span></td>
                                <td><select class="text text-center"  id = "country_of_origin">
                                        <option  value="Китай">Китай</option>
                                        <option value="Германия">Германия</option>
                                        <option value="Россия">Россия</option>
                                        <option value="Украина">Украина</option>
                                    </select></td></tr>
                        </label>
                        {{--<div class="form-check">--}}
                        <tr><td colspan="2"><label>
                                    <input id="cpa" type="checkbox" name="cpa" > <span class="label-text">Товар можно заказать на Маркете</span>
                                </label>
                            </td></tr>
                        <tr><td colspan="2"><label>
                                    <input style="width: 100px" id="bid" min="10" value="10" type="number" name="bid" > <span class="text-center label-text">Стоимость клика по товару в магазине (10 = 0,1 у.е.)</span>
                                </label>
                            </td></tr>
                        <tr><td colspan="2"><label class="text text-center">
                                    <input style="width: 100px" id="cbid" min="10" value="10" type="number" name="cbid" > <span class="text-center label-text">Общая ставка за клик (10 = 0,1 у.е.)</span>
                                </label>
                            </td></tr>
                        {{--</div>--}}
                    {{--<div class="form-check">--}}
                        {{--<label class="toggle">--}}
                            {{--<input onchange="changeLinkContainer()" type="radio" name="bad_links_show_step_2" value="show_all_files"> <span class="label-text">Ранее созданные файлы</span>--}}
                        {{--</label>--}}
                    {{--</div>--}}

                    </table></form>
            </div>

    </div>

    </div>
</div>
<div  id="mpa-template-data" class="bs-calltoaction bs-calltoaction-info">
<div class="row">
    <div class="col-md-12 cta-button">
        <div class="cta-desc">
            <form><table style="font-size: 30px" class="table">
                    <div class="form-check">
                        <tr><td colspan="2"><label class="toggle">
                                    <input onchange="changeLinkContainerMA()" type="radio" name="show_step_2" value="show_exist_file" checked> <span class="label-text">Показать ранее загруженные файлы</span>
                                </label></td></tr>
                    </div>
                    <div class="form-check">
                        <tr><td colspan="2"><label class="toggle">
                                    <input onchange="changeLinkContainerMA()" type="radio" name="show_step_2" value="show_form_load_file"> <span class="label-text">Загрузить из файла</span>
                                </label></td></tr>
                    </div>
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
            <input onclick="MarketplaceYandexStep2()" type="button" class="btn btn-lg btn-block btn-info" value="Дальше" /><br/>
            <input onclick="showMarketplaceExistFile('yandex')" type="button" class="btn btn-lg btn-block btn-info" value="Показать ранее созданные файлы" />

        </div>
    </div>
</div>
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




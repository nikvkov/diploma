<div class = "row">
    <div class = "col-md-12">
        <hr>
    </div>
</div>
<div class="bs-calltoaction bs-calltoaction-info">
    <div class="row">
        <div class="col-md-9 cta-contents">
            <h1 class="cta-title">Шаг 1 : Выберите источник товаров</h1>
            <div class="cta-desc">
                <form><table style="font-size: 30px" class="table">
                        {{--<div class="form-check">--}}
                        <label class="toggle">
                                <tr><td> <span class="label-text">Выберите оригинальный язык</span></td>
                           <td> <select class="text text-center"  id = "amazon_ads_original_lang">
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
                            <td><select class="text text-center"  id = "amazon_ads_localization">
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
                            <tr><td><span class="label-text">Статус кампании</span></td>
                                <td><select class="text text-center"  id = "amazon_ads_category_status">
                                    <option value="Enabled">Запущена</option>
                                    <option selected value="Paused">Пауза</option>
                                </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td><span class="label-text">Метод задания ключевых слов</span></td>
                                <td><select onchange="showKeywordBlock()" class="text text-center"  id = "amazon_ads_type_keywords">
                                   <option selected value="Auto">Автоматический подбор</option>
                                   <option value="Manual">Задать вручную</option>
                            </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                        <tr style="display: none"  id = "show_keywords"><td><span class="label-text">Задайте шаблон ключевых слов</span></td>
                              <td><textarea placeholder="Ключевые слова(одно на строку)" class="text text-center"  id = "amazon_ads_template_keyword">купить [*]</textarea></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr style="display: none"  id="show_match_type"><td><span class="label-text">Тип соответствия ключевых слов</span></td>
                               <td><select class="text text-center"  id = "amazon_ads_match_type_keywords">
                                  <option selected value="Broad">Широкое</option>
                                  <option value="Exact">Точное</option>
                                  <option value="Phrase">Фразовое</option>
                                  <option value="Negative Exact">Минус Точное</option>
                                  <option value="Negative Phrase">Минус Фразовое</option>
                            </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                            <label class="toggle">
                                <tr><td><span class="label-text">Дневной бютжет кампании</span></td>
                                    <td>
                                        <input class="text text-center" type="number" min="2" value="2" id = "amazon_ads_daily_budget">
                                    </td></tr>
                            </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                            <label class="toggle">
                                <tr><td><span class="label-text">Дата начала кампании</span></td>
                                    <td>
                                        <input class="text text-center" type="date" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" id = "amazon_ads_start_date">
                                    </td></tr>
                            </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <tr><td colspan="2"><label class="toggle">
                            <input onchange="changeLinkContainerAmazonAds()" type="radio" name="amazon_ads_show_step_2" value="show_exist_file" checked> <span class="label-text">Показать ранее созданные файлы импорта для Amazon</span>
                                </label></td></tr>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <tr><td colspan="2"><label class="toggle">
                            <input onchange="changeLinkContainerAmazonAds()" type="radio" name="amazon_ads_show_step_2" value="show_form_load_file"> <span class="label-text">Загрузить файл экспорта Amazon</span>
                        </label></td></tr>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        {{--<label class="toggle">--}}
                            {{--<input onchange="changeLinkContainer()" type="radio" name="bad_links_show_step_2" value="show_all_files"> <span class="label-text">Ранее созданные файлы</span>--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <tr><td colspan="2"><label>
                            <input onchange="showEmailField()" id="is_need_email" type="checkbox" name="is_need_email" > <span class="label-text">Направить сообщение на email по окончании создания файла?</span>
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
        <div class="col-md-3 cta-button">
            <input onclick="amazonSponsoredProductsStep2()" type="button" class="btn btn-lg btn-block btn-info" value="Дальше" /><br/>
            <input onclick="amazonSponsoredProductsExistFile('amazon_ads')" type="button" class="btn btn-lg btn-block btn-info" value="Показать ранее созданные файлы" />

        </div>
    </div>
</div>
{{--<div style="display: none" id="mpa-template-data" class="bs-calltoaction bs-calltoaction-info">--}}

{{--</div>--}}
<div style="display: none" id="amazon-ads-step-2" class="bs-calltoaction bs-calltoaction-info">

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
<div style="display: none" id="amazon-ads-step-3" class="bs-calltoaction bs-calltoaction-info">

</div>
<div style="display: none" id="amazon-ads-step-4" class="bs-calltoaction bs-calltoaction-info">

</div>







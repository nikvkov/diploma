<style>
    .am_temp{
        width: 800px;
    }
</style>
<div id="accordion">
<div class="row" data-toggle="collapse" data-parent="#accordion" aria-expanded="true">
    <div class="col-md-9 cta-contents">
        <h1 class="cta-title">Шаблон данных</h1>
        <div class="cta-desc">
            <form><table style="font-size: 24px" class="table">

                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Укажите категорию</span></td>
                                <td> <select class="am_temp text text-center"  id = "amazon_feed_product_type">
                                        @foreach($template_data["feed_product_type"] as $item)
                                        <option  value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Тип уникального идентификатора</span></td>
                                <td> <select class="am_temp text text-center"  id = "amazon_external_product_id_type">
                                        @foreach($template_data["external_product_id_type"] as $item)
                                            <option @if($item=="EAN") selected @endif  value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Тип вариации</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_variation_theme">
                                        @foreach($template_data["variation_theme"] as $item)
                                            <option  value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Тип обновления</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_update_delete">
                                        @foreach($template_data["update_delete"] as $item)
                                            <option  value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Карта размера</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_size_map">
                                        <option  value="">Выберите размер(если необходимо)</option>
                                        @foreach($template_data["size_map"] as $item)
                                            <option  value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Единица измерения длины</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_item_display_length_unit_of_measure">
                                        @foreach($template_data["item_display_length_unit_of_measure"] as $item)
                                            <option @if($item=="MM") selected @endif value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Единица измерения размеров</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_item_dimensions_unit_of_measure">
                                        @foreach($template_data["item_dimensions_unit_of_measure"] as $item)
                                            <option @if($item=="MM") selected @endif value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Единица измерения веса</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_item_weight_unit_of_measure">
                                        @foreach($template_data["item_weight_unit_of_measure"] as $item)
                                            <option @if($item=="KG") selected @endif value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Единица измерения веса при продаже через сайт</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_website_shipping_weight_unit_of_measure">
                                        @foreach($template_data["website_shipping_weight_unit_of_measure"] as $item)
                                            <option @if($item=="KG") selected @endif value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Единица измерения размера упаковки </span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_package_dimensions_unit_of_measure">
                                        @foreach($template_data["package_dimensions_unit_of_measure"] as $item)
                                            <option @if($item=="MM") selected @endif value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Единица измерения веса упаковки </span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_package_weight_unit_of_measure">
                                        @foreach($template_data["package_weight_unit_of_measure"] as $item)
                                            <option @if($item=="KG") selected @endif value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Выберите страну-производителя</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_country_of_origin">
                                        @foreach($template_data["country_of_origin"] as $item)
                                            <option @if($item=="China") selected @endif value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Материал батареи</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_battery_cell_composition">
                                        <option value="">Выберите материал батареи(при необходимости)</option>
                                        @foreach($template_data["battery_cell_composition"] as $item)
                                            <option value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Тип батареи</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_battery_type">
                                        <option value="">Выберите тип батареи(при необходимости)</option>
                                        @foreach($template_data["battery_type"] as $item)
                                            <option value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Тип упаковки литиевой батареи</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_lithium_battery_packaging">
                                        <option value="">Выберите тип упаковки(при необходимости)</option>
                                        @foreach($template_data["lithium_battery_packaging"] as $item)
                                            <option value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Наличие батареи</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_are_batteries_included">
                                        <option value="">Выберите наличие(при необходимости)</option>
                                        @foreach($template_data["are_batteries_included"] as $item)
                                            <option value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Выберите возрастные параметры директивы безопасности</span></td>
                                <td> <select  class="text text-center am_temp"  id = "amazon_eu_toys_safety_directive_age_warning">
                                        <option value="">Выберите параметр(при необходимости)</option>
                                        @foreach($template_data["eu_toys_safety_directive_age_warning"] as $item)
                                            <option value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Выберите описание директивы безопасности</span></td>
                                <td> <select  class="text text-center am_temp"  id = "amazon_eu_toys_safety_directive_warning">
                                        <option value="">Выберите параметр(при необходимости)</option>
                                        @foreach($template_data["eu_toys_safety_directive_warning"] as $item)
                                            <option value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                        <label class="toggle">
                            <tr><td> <span class="label-text">Выберите язык директивы безопасности</span></td>
                                <td> <select class="text text-center am_temp"  id = "amazon_eu_toys_safety_directive_language">
                                        <option value="">Выберите параметр(при необходимости)</option>
                                        @foreach($template_data["eu_toys_safety_directive_language"] as $item)
                                            <option value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select></td></tr>
                        </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Укажите валюту</span></td>
                            <td> <select class="text text-center am_temp"  id = "amazon_currency">
                                    <option value="">Укажите валюту</option>
                                    @foreach($template_data["currency"] as $item)
                                        <option @if($item=="EUR") selected @endif value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select></td></tr>
                    </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Укажите состояние</span></td>
                            <td> <select class="text text-center am_temp"  id = "amazon_condition_type">
                                    {{--<option value="">Укажите состояние</option>--}}
                                    @foreach($template_data["condition_type"] as $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select></td></tr>
                    </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Выберите код товара</span></td>
                            <td> <select class="text text-center am_temp"  id = "amazon_product_tax_code">
                                    <option value="">Укажите код(по желанию)</option>
                                    @foreach($template_data["product_tax_code"] as $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select></td></tr>
                    </label>
                    {{--</div>--}}
                    {{--<div class="form-check">--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Укажите описание 1 </span></td>
                            <td> <textarea class="text text-center am_temp"  id = "amazon_bullet_point1">чехол для телефона</textarea></td></tr>
                    </label>
                    {{--</div>--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Укажите описание 2 </span></td>
                            <td> <textarea class="text text-center am_temp"  id = "amazon_bullet_point2">Высокофункциональный чехол для телефона</textarea></td></tr>
                    </label>
                    {{--</div>--}}
                    {{--</div>--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Укажите описание 3 </span></td>
                            <td> <textarea class="text text-center am_temp"  id = "amazon_bullet_point3">Чехол для телефона с креплением</textarea></td></tr>
                    </label>
                    {{--</div>--}}
                    {{--</div>--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Укажите описание 4 </span></td>
                            <td> <textarea class="text text-center am_temp"  id = "amazon_bullet_point4">Настоящее немецкое качество</textarea></td></tr>
                    </label>
                    {{--</div>--}}
                    {{--</div>--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Укажите описание 5 </span></td>
                            <td> <textarea class="text text-center am_temp"  id = "amazon_bullet_point5">Чехлы с креплением к гладкой поверхности</textarea></td></tr>
                    </label>
                    {{--</div>--}}
                    {{--</div>--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Укажите блок ключевых слов 1 </span></td>
                            <td> <textarea class="text text-center am_temp"  id = "amazon_generic_keywords1">купить чехол для телефона</textarea></td></tr>
                    </label>
                    {{--</div>--}}
                    {{--</div>--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Укажите блок ключевых слов 2 </span></td>
                            <td> <textarea class="text text-center am_temp"  id = "amazon_generic_keywords2">функциональный защитный чехол</textarea></td></tr>
                    </label>
                    {{--</div>--}}
                    {{--</div>--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Укажите блок ключевых слов 3 </span></td>
                            <td> <textarea class="text text-center am_temp"  id = "amazon_generic_keywords3">кожаный чехол</textarea></td></tr>
                    </label>
                    {{--</div>--}}
                    {{--</div>--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Укажите блок ключевых слов 4 </span></td>
                            <td> <textarea class="text text-center am_temp"  id = "amazon_generic_keywords4">смарт-держатель</textarea></td></tr>
                    </label>
                    {{--</div>--}}
                    {{--</div>--}}
                    <label class="toggle">
                        <tr><td> <span class="label-text">Укажите блок ключевых слов 5 </span></td>
                            <td> <textarea class="text text-center am_temp"  id = "amazon_generic_keywords5">чехол с креплением</textarea></td></tr>
                    </label>
                    {{--</div>--}}

                </table></form>
        </div>
    </div>
    <div class="col-md-3 cta-button">
        {{--<input onclick="MarketplaceAmazonStep2()" type="button" class="btn btn-lg btn-block btn-info" value="Дальше" />--}}
    </div>
</div>
</div>
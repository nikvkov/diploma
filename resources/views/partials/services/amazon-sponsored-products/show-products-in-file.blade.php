sfsefsefsefse

{{--<div class="row">--}}
    {{--<div class="col-md-12 cta-button">--}}
        {{--<button onclick="createAmazonAdsFile()" class="btn btn-lg btn-block btn-info">Сформировать файл</button>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="row">--}}
    {{--<div class="col-md-9 cta-contents">--}}
        {{--<h1 class="cta-title">Выберите товары для включения в файл</h1>--}}
        {{--<div class="cta-desc">--}}
            {{--<div class="wrapper">--}}
                {{--<table  class='table table-hover table-bordered table-condensed'>--}}
                    {{--<thead class="thead-inverse">--}}
                    {{--<tr >--}}
                        {{--<th class="text-center"><form role='form' class='form-inline'><div class='form-group'>--}}
                                    {{--<input onchange='checkAllRow()' id = 'allCheckInTable' class='form-control input-lg' type='checkbox' checked = 'true'/>--}}
                                    {{--<div class="form-check">--}}
                                        {{--<label>--}}
                                            {{--<input checked = 'true'  onchange='checkAllProductAds()' id = 'allCheckInTable' type="checkbox" name="allCheckInTable" > <span class="label-text"></span>--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div></form></th>--}}
                        {{--<th class="text-center">Товар</th>--}}
                        {{--<th class="text-center">Вариации</th>--}}
                        {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody id="linksForSitemap">--}}
                    {{--@foreach($ads_products as $item)--}}
                        {{--<form role='form' class='form-inline'><div class="form-check"><div class='form-group'>--}}
                                    {{--<tr  >--}}
                                        {{--<td>--}}
                                            {{--<input class='form-control input-lg' id = 'link{{$i}}' type='checkbox' value='{{$links[$i]}}' checked = 'true'/>--}}
                                            {{--<div class="form-check">--}}
                                                {{--<label>--}}
                                                    {{--<input  id = 'ads{{$item->sku}}' type="checkbox" value='{{$item->sku}}' checked = 'true' > <span class="label-text"></span>--}}
                                                {{--</label>--}}
                                            {{--</div>--}}
                                        {{--</td>--}}
                                        {{--<td><label class='form-control input-sm' for='ads{{$item->sku}}'>{{$item->title}}</label></td>--}}

                                        {{--<td>--}}
                                            {{--<table class="table">--}}
                                            {{--@foreach($item->childs as $child)--}}

                                                    {{--<tr><td>{{$child->sku}}</td><td>{{$child->title}}</td></tr>--}}

                                            {{--@foreach--}}
                                            {{--</table>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                {{--</div></div></form>--}}
                    {{--@endforeach--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="row">--}}
    {{--<div class="col-md-6 cta-button">--}}
        {{--<button onclick="createXMLFile()" class="btn btn-lg btn-block btn-info">Сформировать  в XML</button>--}}
    {{--</div>--}}
    {{--<div class="col-md-6 cta-button">--}}
        {{--<button onclick="createHTMLFile()" class="btn btn-lg btn-block btn-info">Сформировать  в HTML</button>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@for($i=0; $i<count($ads_products); $i++)--}}
    {{--{{$ads_products[$i]->sku}}--}}
    {{--@endfor--}}
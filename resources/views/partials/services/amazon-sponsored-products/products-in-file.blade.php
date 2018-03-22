
<div class="row">
    <div class="col-md-6 cta-button">
        <button onclick="previewAmazonAdsFile()" class="btn btn-lg btn-block btn-info">Предварительный просмотр файла</button>
    </div>
    <div class="col-md-6 cta-button">
        <button onclick="createAmazonAdsFile()" class="btn btn-lg btn-block btn-info">Сформировать файл</button>
    </div>
</div>


<div class="row">
    <div class="col-md-9 cta-contents">
    {{--<h1 class="cta-title">Выберите товары для включения в файл</h1>--}}
        <div class="cta-desc">
            <div class="wrapper">
                <table class='table table-hover table-bordered table-condensed'>
                    <thead class="thead-inverse">
                        <tr >
                            <th class="text-center"><form role='form' class='form-inline'><div class='form-group'>
                                {{--<input onchange='checkAllRow()' id = 'allCheckInTable' class='form-control input-lg' type='checkbox' checked >--}}
                                <div class="form-check">
                                <label>
                                <input checked   onchange='checkAllProductAds()' id = 'allCheckInTable' type="checkbox" name="allCheckInTable" > <span class="label-text"></span>
                                </label>
                                </div>
                                </div></form>
                            </th>
                            <th class="text-center">Товар</th>
                            <th class="text-center">Вариации</th>
                        </tr>
                    </thead>
                    <tbody id="productsForFile">
                        @for($i=0; $i<count($ads_products); $i++)
                            <form role='form' class='form-inline'><div class="form-check"><div class='form-group'>
                           <tr>
                               <td>
                                   {{--<input class='form-control input-lg' id = 'link{{$i}}' type='checkbox' value='{{$links[$i]}}' checked = 'true'/>--}}
                                   {{--<div class="form-check">--}}
                                   <label>
                                   <input  id = 'ads{{$ads_products[$i]->sku}}' type="checkbox" value='{{$ads_products[$i]->sku}}' checked = 'true' > <span class="label-text"></span>
                                   </label>
                                   {{--</div>--}}
                               </td>

                               <td><label class='form-control input-sm' for='ads{{$ads_products[$i]->sku}}'>{{$ads_products[$i]->title}}</label></td>

                               <td>
                                   <table class="table">
                                       @foreach($ads_products[$i]->childs as $child)
                                           <tr><td>{{$child->sku}}</td><td>{{$child->title}}</td></tr>
                                       @endforeach
                                   </table>
                               </td>
                           </tr>
                            </div></div></form>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 cta-button">
        <button onclick="previewAmazonAdsFile()" class="btn btn-lg btn-block btn-info">Предварительный просмотр файла</button>
    </div>
    <div class="col-md-6 cta-button">
        <button onclick="createAmazonAdsFile()" class="btn btn-lg btn-block btn-info">Сформировать файл</button>
    </div>
</div>

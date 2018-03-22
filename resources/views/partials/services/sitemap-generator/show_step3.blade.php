<div class="row">
    <div class="col-md-6 cta-button">
        <button onclick="createXMLFile()" class="btn btn-lg btn-block btn-info">Сформировать  в XML</button>
    </div>
    <div class="col-md-6 cta-button">
        <button onclick="createHTMLFile()" class="btn btn-lg btn-block btn-info">Сформировать  в HTML</button>
    </div>
</div>
<div class="row">
    <div class="col-md-9 cta-contents">
        <h1 class="cta-title">Выберите ссылки для включения в карту сайта</h1>
        <div class="cta-desc">
            <div class="wrapper">
                <table  class='table table-hover table-bordered table-condensed'>
                    <thead class="thead-inverse">
                    <tr >
                        <th class="text-center"><form role='form' class='form-inline'><div class='form-group'>
                                    {{--<input onchange='checkAllRow()' id = 'allCheckInTable' class='form-control input-lg' type='checkbox' checked = 'true'/>--}}
                                    <div class="form-check">
                                        <label>
                                            <input checked = 'true'  onchange='checkAllRow()' id = 'allCheckInTable' type="checkbox" name="is_need_email" > <span class="label-text"></span>
                                        </label>
                                    </div>
                                </div></form></th>
                        <th class="text-center">Ссылка</th>
                        <th class="text-center">Приоритет</th>
                        <th class="text-center">Частота изменения</th>
                    </tr>
                    </thead>
                    <tbody id="linksForSitemap">
                    @for($i=0;$i<count($links); $i++)
                        <form role='form' class='form-inline'><div class="form-check"><div class='form-group'>
                        <tr  >
                            <td>
                                {{--<input class='form-control input-lg' id = 'link{{$i}}' type='checkbox' value='{{$links[$i]}}' checked = 'true'/>--}}
                                <div class="form-check">
                                    <label>
                                        <input  id = 'link{{$i}}' type="checkbox" value='{{$links[$i]}}' checked = 'true' > <span class="label-text"></span>
                                    </label>
                                </div>
                            </td>
                            <td><label class='form-control input-sm' for='link{{$i}}'>{{$links[$i]}}</label></td>
                            <td><select  class='form-control input-sm selectPriority' id="selectPr{{$i}}">
                                    <option value="1.0">1.0</option>
                                    <option selected value="0.8">0.8</option>
                                    <option value="0.6">0.6</option>
                                    <option value="0.4">0.4</option>
                                </select></td>
                            <td><select  class='form-control input-sm selectChange' id="selectCh{{$i}}">
                            <option value="always">always</option>
                            <option value="hourly">hourly</option>
                            <option value="daily">daily</option>
                            <option value="weekly">weekly</option>
                            <option selected value="monthly">monthly</option>
                            <option value="yearly">yearly</option>
                            <option value="never">never</option>
                            </select></td>
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
        <button onclick="createXMLFile()" class="btn btn-lg btn-block btn-info">Сформировать  в XML</button>
    </div>
    <div class="col-md-6 cta-button">
        <button onclick="createHTMLFile()" class="btn btn-lg btn-block btn-info">Сформировать  в HTML</button>
    </div>
</div>
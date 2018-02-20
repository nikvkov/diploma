<div class="col-md-9 cta-contents">
    <h1 class="cta-title">Данные по сервису</h1>
    <div class="cta-desc">
        <div class="wrapper">
            <table id="acrylic" class="table table-bordered">
                <thead >
                <tr class="text-capitalize">
                    <th class="text-center">Сервис</th>
                    <th class="text-center">Количество файлов </th>
                    <th class="text-center">Среднее время создания</th>
                    <th class="text-center"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $item)

                    <tr>
                        <td class="lead" >{{$item->title}}</td>
                        <td class="font-weight-bold text-center">{{count($item->orders)}}</td>
                        <td class="font-weight-bold text-center">{{$item->getAvgOrder()}} сек</td>
                        <td class="font-weight-bold"> <button onclick="ma_showServiceUserOrder({{$item->id}})" class="btn btn-lg btn-block btn-info" >Показать</button></td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@foreach($mailing->allByDesc() as $item)
    <tr  class ="t_row">
        <td scope="row" class="text text-md-center"><input checked="checked" id = "mail{{$item->id}}" type="checkbox" value ="{{$item->id}}"></td>
        <td onclick="viewMailing({{$item->id}})" class="text text-md-center"><label for = "mail{{$item->id}}">{{$item->title}}</label></td>
        <td class="text text-md-center">{{$item->num}}</td>
        <td class="text text-md-center">{{$item->created_at}}</td>
        <td><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="viewMailing({{$item->id}})">Просмотр</button></td>
        <td><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="deleteMailing({{$item->id}})">X</button></td>
        <td><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="orderMailing({{$item->id}})">Отчет</button></td>

    </tr>
@endforeach
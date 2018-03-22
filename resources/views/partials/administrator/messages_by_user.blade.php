@foreach($messages as $page)
    <tr onclick="viewMessage({{$page->id}})" class ="t_row @if($page->read) read @endif">
        <td scope="row" class="text text-md-center"><input checked="checked" id = "mess{{$page->id}}" type="checkbox" value ="{{$page->id}}"></td>
        <td class="text text-md-center"><label for = "mess{{$page->id}}">{{$page->title}}</label></td>
        <td class="text text-md-center">{{$page->user->name}}</td>
        <td class="text text-md-center">{{$page->created_at}}</td>
        <td><button class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2" onclick="deleteMessage({{$page->id}})">X</button></td>
    </tr>
@endforeach
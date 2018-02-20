@foreach($message as $item)
    <div id = "message{{$item->id}}" class="well @if($item->read != 0) read @endif"  onclick="ma_showMessage({{$item->id}})" >
        <div class="media">
            <a style="margin-right: 70px" class="pull-left" href="#">
                <img class="media-object" src="/uploads/admin/no-read-mail.png">
                <button onclick="ma_showMessage({{$item->id}})" class="view btn-sm active">Показать</button>
            </a>
            {{--<div class="pull-left">--}}
            {{--<iframe--}}
            {{--srcdoc="{{$item->content}}" width="750px" height="300px" >--}}
            {{--</iframe>--}}
            {{--</div>--}}
            <div class="media-body" style="margin-left: 70px">
                <h4 class="media-heading">Извещение</h4>
                <p class="text-right">      от сервиса</p>
                <p class="lead"> {{$item->title}}</p>

                <ul class="list-inline list-unstyled">
                    <li><span><i class="glyphicon glyphicon-calendar"></i>{{(new DateTime($item->created_at))->format('F j, Y, g:i a')}}</span></li>

                </ul>
            </div>
        </div>
    </div>

@endforeach
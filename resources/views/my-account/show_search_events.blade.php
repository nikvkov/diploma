@foreach($event as $item)

    <div class="well @if($item->read != 0) read @endif" id="postlist">
        <div onclick="ma_showEvents({{$item->event->id}})" class="panel">
            <div class="panel-heading">
                <div class="text-center">
                    <div class="row">
                        <div class="col-sm-9">
                            <h3 class="pull-left"><span class="label label-default"><i class="glyphicon glyphicon-send"></i> {{$item->event->title}}</span></h3>
                        </div>
                        <div class="col-sm-3">
                            <h4 class="pull-right">
                                <small><em>{{(new DateTime($item->created_at))->format('F j, Y')}}<br>{{(new DateTime($item->created_at))->format('g:i a')}}</em></small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <img src="/uploads/events/small/{{$item->event->image}}">
                    </div>
                    <div class="col-md-6">
                        {!! mb_substr( strip_tags($item->event->body),0,150 )!!}...
                    </div>
                    <div class="col-md-3">
                        <button onclick="ma_showEvents({{$item->event->id}})" class="view btn-sm active" >Подробнееe</button>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                {{--<span class="label label-default">Welcome</span> <span class="label label-default">Updates</span> <span class="label label-default">July</span>--}}
            </div>
        </div>
    </div>

@endforeach
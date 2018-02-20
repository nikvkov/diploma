<div class="row">
    <div class="col-md-5">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

            @foreach($menu['left'] as $item)
                    <li><a href="{{$item->url}}">{{$item->title}}</a></li>
            @endforeach

            </ul>
        </div>
    </div>
    <div class="col-md-3"><img style="width: 50%" src="/uploads/logo.jpg"/> </div>
    <div class="col-md-4">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav ">

            @foreach($menu['right'] as $item)
                        <li><a href="{{$item->url}}">{{$item->title}}</a></li>
            @endforeach

            </ul>
        </div>
    </div>
</div>
<div style="margin-bottom: 20px" class="row">
    <div class="col-md-3">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

            @foreach($menu['left'] as $item)
                    <li class="custom-nav-text"><a class="font-col" href="{{$item->url}}">{{$item->title}}</a></li>
            @endforeach

            </ul>
        </div>
    </div>
    <div class="col-md-offset-1 col-md-4"><img style="width: 100%" src="/uploads/logo.png"/> </div>
    <div class="col-md-offset-1 col-md-3">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav ">

            @foreach($menu['right'] as $item)
                        <li class="custom-nav-text"><a class="font-col" href="{{$item->url}}">{{$item->title}}</a></li>
            @endforeach

            </ul>
        </div>
    </div>
</div>

<style>
    .custom-nav-text{
        font-size: 12px;

        background-color: #336666;

        /*margin-right: 1px;*/
    }

    .font-col{
        color:#FFFFFF;
    }
</style>
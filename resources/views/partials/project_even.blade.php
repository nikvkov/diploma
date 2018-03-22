{{--<div class="row even">--}}

    {{--<div class="col-md-6 image">--}}
        {{--<img src="/uploads/project/medium/{{$id->image}}" alt=""/>--}}
    {{--</div>--}}

    {{--<div class="col-md-6 text">--}}
        {{--<h2>{{$id->title}}</h2>--}}
        {{--<a href="/projects/{{$id->slug}}">Read more</a>--}}
    {{--</div>--}}

{{--</div>--}}

<div style="margin-top: 20px; background-color: #CCFFFF;" class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" data-aos="fade-right">

        <div class="col-lg-6 col-md-4 col-xs-12">
            <img style="height: 75%" src="/uploads/project/medium/{{$id->image}}" alt="" width="100%">
        </div>

        <div class="col-lg-6 col-md-8 col-xs-12">
            <div class="blog-column">
                <h2>{{$id->title}}</h2>
                <ul class="blog-detail list-inline">
                    <li><i class="fa fa-user"></i>admin</li>
                    <li><i class="fa fa-clock-o"></i>{{(new DateTime($id->created_at))->format('F j, Y')}}</li>
                </ul>
                <p style="margin-top: 20px">{!! mb_substr( strip_tags($id->content),0,150 )!!}...</p>
                <a href="/projects/{{$id->slug}}" class="btn btn-primary btn-block">Подробнее</a>
            </div>
        </div>

    </div>
</div>
<hr>
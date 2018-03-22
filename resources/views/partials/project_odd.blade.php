{{--<div class="row">--}}
    {{--<section id="team" class="pb-5">--}}
        {{--<div class="container">--}}
            {{--<h5 class="section-title h1">Доступные проекты</h5>--}}
            {{--<div class="row">--}}
                <!-- Team member -->
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <p><img height="150%" class="img-fluid" src="/uploads/project/medium/{{$id->image}}" alt="card image"></p>
                                        <h4 class="card-title">{{mb_strtoupper($id->title)}}</h4>
                                        <p class="card-text"></p>
                                        <a href="/projects/{{$id->slug}}" title="Перейти к проекту" class="btn btn-primary btn-sm"><i class=" glyphicon glyphicon-eye-open"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="backside">
                                <div class="card">
                                    <div style="margin: 5px" class="card-body text-center mt-4">

                                        <h4 class="card-title">Краткая информация</h4>
                                        {{--<p class="card-text">{!! mb_substr( strip_tags($id->content),0,150 )!!}...</p>--}}
                                        <a style="height: 30px" href="/projects/{{$id->slug}}" title="Перейти к проекту" class="btn btn-primary btn-sm">Перейти к проекту</a>

                                        <h5 class="card-title">Доступные сервисы</h5>

                                        @foreach($id->services as $service)
                                            <p class="card-text">Сервис {{$service->title}}</p>
                                            <a style="height: 30px" href="/projects/{{$id->slug}}/{{$service->slug}}" title="Перейти к сервису" class="btn btn-success btn-sm">Перейти к сервису</a>

                                         @endforeach
                                        <hr>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-skype"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./Team member -->


            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
{{--</div>--}}

{{--<div class="row even">--}}

{{--<div class="col-md-6 image">--}}
{{--<img src="/uploads/project/medium/{{$id->image}}" alt=""/>--}}
{{--</div>--}}

{{--<div class="col-md-6 text">--}}
{{--<h2>{{$id->title}}</h2>--}}
{{--<a href="/projects/{{$id->slug}}">Read more</a>--}}
{{--</div>--}}

{{--</div>--}}
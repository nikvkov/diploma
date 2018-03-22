<footer style="margin-top: 15px">
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> Контакты </h3>
                    <ul>
                        @foreach($menu['footer'] as $item)
                            <li><a href="{{$item->url}}">{{$item->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> Пользователям </h3>
                    <ul>
                        <li> <a href="#">Рекламные компании</a> </li>
                        <li> <a href="#"> Площадки </a> </li>
                        <li> <a href="#"> Проверка </a> </li>

                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> Разработчикам </h3>
                    <ul>
                        <li> <a href="#"> API </a> </li>

                    </ul>
                </div>
                {{--<div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">--}}
                    {{--<h3> Будущее </h3>--}}
                    {{--<ul>--}}
                        {{--<li> <a href="#"> Lorem Ipsum </a> </li>--}}
                        {{--<li> <a href="#"> Lorem Ipsum </a> </li>--}}
                        {{--<li> <a href="#"> Lorem Ipsum </a> </li>--}}
                        {{--<li> <a href="#"> Lorem Ipsum </a> </li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                <div class="col-md-offset-2 col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
                    <h3 id = "subscribe_button"> Оставайтесь с нами! </h3>
                    <ul>
                        <li>
                            <div  class="input-append newsletter-box text-center">
                                <input id="subscribe_email" type="email" class="full text-center" placeholder="Email ">
                                <button  onclick="subscribe()" class="btn  bg-gray" type="button"> Подписаться <i class="fa fa-long-arrow-right"> </i> </button>
                            </div>
                        </li>
                    </ul>
                    <ul class="social">
                        <li> <a href="#"> <i class=" fa fa-facebook">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-twitter">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-google-plus">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-pinterest">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-youtube">   </i> </a> </li>
                    </ul>
                </div>
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </div>
    <!--/.footer-->

    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright 2018 © Kovalenko Nikolaj. All right reserved. </p>
            <div class="pull-right">
                <ul class="nav nav-pills payments">
                    <li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                </ul>
            </div>
        </div>
    </div>
    <!--/.footer-bottom-->
</footer>
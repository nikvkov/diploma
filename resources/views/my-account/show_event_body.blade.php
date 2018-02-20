<div class="col-md-4 blogShort">
    <h1 class="lead">{{$content->title}}</h1>
    <img height="50%" src="/uploads/events/medium/{{$content->image}}" alt="{{$content->title}}" class="pull-left img-responsive postImg img-thumbnail margin10">

</div>
<div class="col-md-8 blogShort">
    <article>
        <p>
           {!!$content->body!!}
        </p>
    </article>

</div>
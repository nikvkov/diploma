<div class="row">
    <div class="col-md-9 cta-contents">
        <h1 class="cta-title">Созданные ранее файлы проверок</h1>
        <div class="cta-desc">
            <div class="wrapper">
                <table id="acrylic" class="table table-bordered">
                    <thead >
                    <tr class="text-capitalize">
                        <th class="text-center">Файл</th>
                        <th class="text-center">Скачать</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($files as $item)

                        <tr >
                            <td class="font-weight-bold">{{$item}}</td>
                            <td > <a class="btn btn-lg btn-block btn-info" href="/uploads/users/bad-links/{{$item}}">Скачать</a></td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

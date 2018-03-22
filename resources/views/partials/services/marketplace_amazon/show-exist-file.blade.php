<div class="row">
    <div class="col-md-9 cta-contents">
        <h1 class="cta-title">Созданные ранее файлы импорта</h1>
        <div class="cta-desc">
            <div class="wrapper">
                <table id="acrylic" class="table table-bordered">
                    <thead >
                    <tr class="text-capitalize">
                        <th class="text-center">Файл</th>
                        <th class="text-center">Размер, кБт</th>
                        <th class="text-center">Дата создания</th>
                        <th class="text-center">Скачать</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($files as $item)

                        <tr class="text text-center" >
                            <td class="font-weight-bold">{{$item->filename}}</td>
                            <td class="font-weight-bold">{{round($item->size/1000,0)}}</td>
                            <td class="font-weight-bold">{{(new DateTime($item->created_at))->format('F j, Y')}}</td>
                            <td > <a class="btn btn-lg btn-block btn-info" href="/{{$item->directory}}/{{$item->filename}}">Скачать</a></td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-md-9 cta-contents">
    <h1 class="cta-title">Данные по файлам</h1>
    <div class="cta-desc">
        <div class="wrapper">
            <table id="acrylic" class="table table-bordered">
                <thead >
                <tr class="text-capitalize">
                    <th class="text-center">Файл</th>
                    <th class="text-center">Сервис</th>
                    <th class="text-center">Проект</th>
                    <th class="text-center">Время создания</th>
                    <th class="text-center">Дата создания</th>
                    <th class="text-center"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($files as $item)

                    <tr>
                        <td class="lead" >{{$item->filename}}</td>
                        {{--<td class="font-weight-bold"></td>--}}
                        {{--<td class="font-weight-bold"></td>--}}
                        <td class="font-weight-bold">{{(new App\Service())->getById($item->service_id)->title}}</td>
                        <td class="font-weight-bold">{{(new App\Project())->getById($item->project_id)->title}}</td>
                        <td class="font-weight-bold">{{$item->create_time}}</td>
                        <td class="font-weight-bold">{{$item->created_at}}</td>
                        <td class="font-weight-bold"> <a class="btn btn-lg btn-block btn-info" href="/{{$item->directory}}/{{$item->filename}}">Скачать</a></td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
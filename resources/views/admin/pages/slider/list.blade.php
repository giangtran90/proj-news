@php
    use App\Helpers\Template as Template;
    use App\Helpers\Highlight as Highlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Slider Info</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $val)
                        @php
                            $index              = $key + 1;
                            $class = ($index % 2 == 0) ? 'even' : 'odd';
                            $id                 = $val['id'];
                            $name               = Highlight::show($val['name'], $params['search'], 'name');
                            $description        = Highlight::show($val['description'], $params['search'], 'description');
                            $link               = Highlight::show($val['link'], $params['search'], 'link');
                            $thumb              = Template::showItemThumb($controllerName, $val['thumb'], $name);
                            $status             = Template::showItemStatus($controllerName, $id, $val['status']);
                            $createdHistory     = Template::showItemHistory($val['created_by'], $val['created']);
                            $modifiedHistory    = Template::showItemHistory($val['modified_by'], $val['modified']);
                            $showButtons        = Template::showButtonAction($controllerName, $id);
                        @endphp
                        <tr class="{{ $class }} pointer">
                            <td class="">{{ $index }}</td>
                            <td width="40%">
                                <p><strong>Name:</strong> {!! $name !!}</p>
                                <p><strong>Desciption:</strong> {!! $description !!}</p>
                                <p><strong>Link:</strong> {!! $link !!}</p>
                                <p>{!! $thumb !!}</p>
                            </td>
                            <td>{!! $status !!}</td>
                            <td>{!! $createdHistory !!}</td>
                            <td>{!! $modifiedHistory !!}</td>
                            <td class="last">{!! $showButtons !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>

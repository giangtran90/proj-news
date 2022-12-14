@extends('admin.main')
@php
    use App\Helpers\Template as Template;
    $xhtmlItemsStatusCount = Template::showButtonFilter($controllerName, $itemsStatusCount, $params['filter']['status'], $params['search']);
    $xhtmlShowAreaSearch   = Template::showAreaSearch($controllerName, $params['search']);
@endphp
@section('content')
    @include('admin.templates.page_header', ['pageIndex' => true]);

    @include('admin.templates.notify')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Bộ Lọc'])
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-7">
                            {!! $xhtmlItemsStatusCount !!}
                        </div>
                        <div class="col-md-5">
                            {!! $xhtmlShowAreaSearch !!}
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--box-lists-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Danh sách'])
                @include('admin.pages.category.list')
            </div>
        </div>
    </div>
    <!--end-box-lists-->
    @if (count($items) > 0)
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    @include('admin.templates.x_title', ['title' => 'Phân trang'])
                    @include('admin.templates.pagination')
                </div>
            </div>
        </div>
    @endif
@endsection

@extends('admin.main')
@php
    use App\Helpers\Template as Template;
    use App\Helpers\Form as FormTemplate;

    $formLabelAttr  = Config::get('zvn.template.form_label');
    $formInputAttr  = Config::get('zvn.template.form_input');
    $statusValue    = ['default'    => 'Select Status', 
                       'active'     => Config::get('zvn.template.status.active.name'), 
                       'inactive'   => Config::get('zvn.template.status.inactive.name')
                      ];
    $isHomeValue    = ['default'    => 'Select is home', 
                       'yes'        => Config::get('zvn.template.is_home.yes.name'), 
                       'no'         => Config::get('zvn.template.is_home.no.name')
                      ];
    $displayValue   = ['default'    => 'Select display', 
                       'list'       => Config::get('zvn.template.display.list.name'), 
                       'grid'       => Config::get('zvn.template.display.grid.name')
                      ];
    $inputHiddenID  = Form::hidden('id', $item['id']);

    $elements = [
        [
            'label'     => Html::decode(Form::label('name', 'Tên <span class="required">*</span>', $formLabelAttr)),
            'element'   => Form::text('name', $item['name'], $formInputAttr)
        ],
        [
            'label'     => Html::decode(Form::label('status', 'Trạng thái <span class="required">*</span>', $formLabelAttr)),
            'element'   => Form::select('status', $statusValue, $item['status'], $formInputAttr)
        ],
        [
            'label'     => Html::decode(Form::label('is_home', 'Hiển thị trang chủ <span class="required">*</span>', $formLabelAttr)),
            'element'   => Form::select('is_home', $isHomeValue, $item['is_home'], $formInputAttr)
        ],
        [
            'label'     => Html::decode(Form::label('display', 'Kiểu hiển thị <span class="required">*</span>', $formLabelAttr)),
            'element'   => Form::select('display', $displayValue, $item['display'], $formInputAttr)
        ],
        [
            'element'   => $inputHiddenID . Form::submit('Lưu', ['class' => 'btn btn-success']),
            'type'      => "btn-submit"
        ],
    ];

@endphp
@section('content')
    @include('admin.templates.page_header', ['pageIndex' => false])
    @include('admin.templates.error')

    <!--box-lists-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form'])

                <div class="x_content">
                    {!! Form::open([
                        'method'            => 'post',
                        'url'               => route($controllerName . '/save'),
                        'accept-charset'    => 'UTF-8',
                        'enctype'           => 'multipart/form-data',
                        'class'             => 'form-horizontal form-label-left',
                        'id'                => 'main-form',
                    ]) !!}
                    {!! FormTemplate::show($elements) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
@endsection

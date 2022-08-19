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
    $inputHiddenID  = Form::hidden('id', $item['id']);
    $inputHiddenThumb  = Form::hidden('thumb-current', $item['thumb']);

    $elements = [
        [
            'label'     => Html::decode(Form::label('name', 'Name <span class="required">*</span>', $formLabelAttr)),
            'element'   => Form::text('name', $item['name'], $formInputAttr)
        ],
        [
            'label'     => Html::decode(Form::label('description', 'Description <span class="required">*</span>', $formLabelAttr)),
            'element'   => Form::text('description', $item['description'], $formInputAttr)
        ],
        [
            'label'     => Html::decode(Form::label('status', 'Status <span class="required">*</span>', $formLabelAttr)),
            'element'   => Form::select('status', $statusValue, $item['status'], $formInputAttr)
        ],
        [
            'label'     => Html::decode(Form::label('link', 'Link <span class="required">*</span>', $formLabelAttr)),
            'element'   => Form::text('link', $item['link'], $formInputAttr)
        ],
        [
            'label'     => Form::label('thumb', 'Thumb', $formLabelAttr),
            'element'   => Form::file('thumb', $formInputAttr),
            'thumb'     => (!empty($item['id'])) ? Template::showItemThumb($controllerName, $item['thumb'], $item['name']) : null,
            'type'      => "thumb"
        ],
        [
            'element'   => $inputHiddenID . $inputHiddenThumb . Form::submit('Lưu', ['class' => 'btn btn-success']),
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

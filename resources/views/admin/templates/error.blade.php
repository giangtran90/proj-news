@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h3><strong><i class="fa fa-exclamation-triangle"></i> Warning!</strong></h3>
        @foreach ($errors->all() as $error)
            <p><strong> + {{ $error }}</strong></p>
        @endforeach
    </div>
@endif

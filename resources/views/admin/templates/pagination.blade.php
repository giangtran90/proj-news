@php
    $totalItems         = $items->total();
    $totalPages         = $items->lastPage();
    $totalItemsPerPage  = $items->perPage();
@endphp
<div class="x_content">
    <div class="row">
        <div class="col-md-6">
            <p class="m-b-0">
                <span class="label label-info label-pagination">{{ $totalItemsPerPage }} items per page</span>
                <span class="label label-success label-pagination">{{ $totalItems }} items</span>
                <span class="label label-danger label-pagination">{{ $totalPages }} pages</span>
            </p>
        </div>
        <div class="col-md-6">
            {!! $items->appends(request()->input())->links('pagination.pagination_backend') !!}
        </div>
    </div>
</div>
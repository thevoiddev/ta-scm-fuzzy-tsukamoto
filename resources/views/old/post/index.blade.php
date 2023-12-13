@extends('layouts.dashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">{{ $main_content }}</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('post.create') }}"><button class="btn btn-success mb-3"><i class="fas fa-plus mr-2"></i> Add {{ $main_content }}</button></a>
            <div class="table-responsive">
                <table class="table table-bordered" id="PostDatatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Post</th>
                            <th width="10%">Visitor</th>
                            <th width="20%">Publish</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
var PostDatatable = $('#PostDatatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('post.datatable') }}",
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'detail', name: 'detail'},
        {data: 'visitor', name: 'visitor'},
        {data: 'published', name: 'published'},
        {
            data: 'action', 
            name: 'action', 
            orderable: true, 
            searchable: true
        },
    ]
});
</script>
@endsection
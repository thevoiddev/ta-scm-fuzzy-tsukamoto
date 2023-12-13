@extends('layouts.dashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">{{ $main_content }}</h6>
        </div>
        <div class="card-body">
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#AddNewsCategory"><i class="fas fa-plus mr-2"></i> Add {{ $main_content }}</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="NewsCategoryDatatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Name</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="AddNewsCategory" tabindex="-1" role="dialog" aria-labelledby="AddNewsCategoryLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="AddNewsCategoryLabel">Add {{ $main_content }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form id="AddNewsCategoryForm" action="{{ route('news_category.create') }}" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter category" name="name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" form="AddNewsCategoryForm"><i class="fas fa-save mr-2"></i>Save</button>
                </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="EditNewsCategory" tabindex="-1" role="dialog" aria-labelledby="EditNewsCategoryLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="EditNewsCategoryLabel">Add {{ $main_content }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form id="EditNewsCategoryForm">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter category" name="name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" form="EditNewsCategoryForm"><i class="fas fa-save mr-2"></i>Save</button>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
var NewsCategoryDatatable = $('#NewsCategoryDatatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('news_category.datatable') }}",
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {
            data: 'action', 
            name: 'action', 
            orderable: true, 
            searchable: true
        },
    ]
});

$('#AddNewsCategory').on('hidden.bs.modal', function (e) {
    const MODAL = $(e.currentTarget);
    
    MODAL.find('form .alert').remove();
});

$('#EditNewsCategory').on('hidden.bs.modal', function (e) {
    const MODAL = $(e.currentTarget);
    
    MODAL.find('form .alert').remove();
});

$('#AddNewsCategoryForm').submit(function(e){
    e.preventDefault();

    const FORM = $(e.currentTarget);
    const SUBMIT_BUTTON = $(`button[form="${e.currentTarget.id}"]`);
    const LOADING_BUTTON_CONTENT = `<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`;
    const SUBMIT_BUTTON_CONTENT = SUBMIT_BUTTON[0].innerHTML;

    SUBMIT_BUTTON[0].innerHTML = LOADING_BUTTON_CONTENT;
    SUBMIT_BUTTON.prop('disabled', true);
    FORM.find('.alert').remove();

    $.ajax({
        url : FORM.attr('action'),
        type : FORM.attr('method'),
        data : FORM.serialize(),
        success : function(response) {   
            SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', false);
            FORM[0].reset();
            FORM.prepend(BootstrapAlert(response.message, 'success'));

            NewsCategoryDatatable.ajax.reload(null, false);
        },
        error : function(request,error)
        {
            SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', false);

            FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
        }
    });
});

$('#NewsCategoryDatatable tbody').on('click', '.btn-action-edit', function() {
    var NewsCategoryData = NewsCategoryDatatable.row($(this).parents('tr')).data();
    if (NewsCategoryData === undefined) NewsCategoryData = NewsCategoryDatatable.row($(this)).data();
    
    $('#EditNewsCategoryForm').attr('action', NewsCategoryData.update_endpoint);
    $('#EditNewsCategoryForm').attr('method', NewsCategoryData.update_method);
    $('#EditNewsCategoryForm [name="name"]').val(NewsCategoryData.name);
    $('#EditNewsCategory').modal('show');
});

$('#EditNewsCategoryForm').submit(function(e){
    e.preventDefault();

    const FORM = $(e.currentTarget);
    const SUBMIT_BUTTON = $(`button[form="${e.currentTarget.id}"]`);
    const LOADING_BUTTON_CONTENT = `<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`;
    const SUBMIT_BUTTON_CONTENT = SUBMIT_BUTTON[0].innerHTML;
    
    SUBMIT_BUTTON[0].innerHTML = LOADING_BUTTON_CONTENT;
    SUBMIT_BUTTON.prop('disabled', true);
    FORM.find('.alert').remove();
    
    $.ajax({
        url : FORM.attr('action'),
        type : FORM.attr('method'),
        data : FORM.serialize(),
        success : function(response) {   
            SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', false);

            FORM.prepend(BootstrapAlert(response.message, 'success'));

            NewsCategoryDatatable.ajax.reload(null, false);
        },
        error : function(request,error)
        {
            SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', false);

            FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
        }
    });
});

$('#NewsCategoryDatatable tbody').on('click', '.btn-action-delete', function() {
    var NewsCategoryData = NewsCategoryDatatable.row($(this).parents('tr')).data();
    if (NewsCategoryData === undefined) NewsCategoryData = NewsCategoryDatatable.row($(this)).data();
    
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1cc88a',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : NewsCategoryData.delete_endpoint,
                type : NewsCategoryData.delete_method,
                success : function(response) {
                    NewsCategoryDatatable.ajax.reload(null, false);
                    Swal.fire('Info', response.message, 'success');
                },
                error : function(request,error)
                {
                    Swal.fire('Info', request.responseJSON.message, 'info');
                }
            });
        }
    });
});
</script>
@endsection
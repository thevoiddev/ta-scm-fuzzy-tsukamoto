@extends('layouts.dashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">{{ $main_content }}</h6>
        </div>
        <div class="card-body">
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#AddNewCarousel"><i class="fas fa-plus"></i> Add {{ $main_content }}</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="CarouselDatatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="40%">Image</th>
                            <th>Detail</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="AddNewCarousel" tabindex="-1" role="dialog" aria-labelledby="AddNewCarouselLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="AddNewCarouselLabel">Add {{ $main_content }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form id="AddNewCarouselForm" action="{{ route('slider.create') }}" method="POST">
                        <div class="form-group">
                            <div class="image-preview">
                                <div class="image-preview-container">
                                    <i class="fas fa-file-image"></i>
                                    <p>Upload an image</p>
                                    <img id="AddNewCarouselImagePreview" src="" alt="Slider Image">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="AddNewCarouselImage" accept="image/png, image/gif, image/jpeg" name="image" required>
                                <label class="custom-file-label">Choose file...</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter title" name="title" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter description" name="description" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter button text" name="button_text">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter link" name="link">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" form="AddNewCarouselForm"><i class="fas fa-save mr-2"></i>Save</button>
                </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="EditCarousel" tabindex="-1" role="dialog" aria-labelledby="EditCarouselLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="EditCarouselLabel">Add {{ $main_content }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form id="EditCarouselForm">
                        <div class="form-group">
                            <div class="image-preview">
                                <div class="image-preview-container">
                                    <i class="fas fa-file-image"></i>
                                    <p>Upload an image</p>
                                    <img id="EditCarouselImagePreview" src="" alt="Slider Image">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="EditCarouselImage" accept="image/png, image/gif, image/jpeg" name="image">
                                <label class="custom-file-label">Choose file...</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter title" name="title" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter description" name="description" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter button text" name="button_text">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter link" name="link">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" form="EditCarouselForm"><i class="fas fa-save mr-2"></i>Save</button>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
var CarouselDatatable = $('#CarouselDatatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('slider.datatable') }}",
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'image_preview', name: 'image_preview'},
        {data: 'detail', name: 'detail'},
        {
            data: 'action', 
            name: 'action', 
            orderable: true, 
            searchable: true
        },
    ]
});

$('#AddNewCarouselImage').on('change', function(e){
    var Filename = e.target.files[0].name;
    $(this).next('#AddNewCarouselForm .custom-file-label').text(Filename);

    if (e.target.files && e.target.files[0]) {
        $('#AddNewCarouselForm .image-preview-container i, #AddNewCarouselForm .image-preview-container p').hide();

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#AddNewCarouselImagePreview')
                .attr('src', e.target.result);
        };
        
        reader.readAsDataURL(e.target.files[0]);
    }
});

$('#EditCarouselImage').on('change', function(e){
    var Filename = e.target.files[0].name;
    $(this).next('#EditCarouselForm .custom-file-label').text(Filename);

    if (e.target.files && e.target.files[0]) {
        $('#EditCarouselForm .image-preview-container i, #EditCarouselForm .image-preview-container p').hide();

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#EditCarouselImagePreview')
                .attr('src', e.target.result);
        };
        
        reader.readAsDataURL(e.target.files[0]);
    }
});

$('#AddNewCarousel').on('hidden.bs.modal', function (e) {
    const MODAL = $(e.currentTarget);
    
    MODAL.find('form')[0].reset();
    MODAL.find('form .alert').remove();
    MODAL.find('form img').attr('src', '');
    MODAL.find('#AddNewCarouselForm .custom-file-label').text('Choose file...');

    $('#AddNewCarouselForm .image-preview-container i, #AddNewCarouselForm .image-preview-container p').show();
});

$('#AddNewCarouselForm').submit(function(e){
    e.preventDefault();
    
    const FORM = $(e.currentTarget);
    const FORM_DATA = new FormData(e.currentTarget);
    const SUBMIT_BUTTON = $(`button[form="${e.currentTarget.id}"]`);
    const LOADING_BUTTON_CONTENT = `<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`;
    const SUBMIT_BUTTON_CONTENT = SUBMIT_BUTTON[0].innerHTML;

    SUBMIT_BUTTON[0].innerHTML = LOADING_BUTTON_CONTENT;
    SUBMIT_BUTTON.prop('disabled', true);

    FORM.find('.alert').remove();

    $.ajax({
        url : FORM.attr('action'),
        type : FORM.attr('method'),
        data : FORM_DATA,
        processData: false,
        contentType: false,
        success : function(response) {   
            SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', false);

            FORM[0].reset();
            FORM.find('.alert').remove();
            FORM.find('img').attr('src', '');
            $('#AddNewCarousel').find('#AddNewCarouselForm .custom-file-label').text('Choose file...');

            $('#AddNewCarouselForm .image-preview-container i, #AddNewCarouselForm .image-preview-container p').show();

            FORM.prepend(BootstrapAlert(response.message, 'success'));

            CarouselDatatable.ajax.reload(null, false);
        },
        error : function(request,error)
        {
            SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', false);

            FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
        }
    });
});

$('#EditCarouselForm').submit(function(e){
    e.preventDefault();
    
    const FORM = $(e.currentTarget);
    const FORM_DATA = new FormData(e.currentTarget);
    const SUBMIT_BUTTON = $(`button[form="${e.currentTarget.id}"]`);
    const LOADING_BUTTON_CONTENT = `<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`;
    const SUBMIT_BUTTON_CONTENT = SUBMIT_BUTTON[0].innerHTML;

    SUBMIT_BUTTON[0].innerHTML = LOADING_BUTTON_CONTENT;
    SUBMIT_BUTTON.prop('disabled', true);

    FORM.find('.alert').remove();

    $.ajax({
        url : FORM.attr('action'),
        type : FORM.attr('method'),
        data : FORM_DATA,
        processData: false,
        contentType: false,
        success : function(response) {   
            SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', false);

            FORM.find('#AddNewCarouselForm .custom-file-label').text('Choose file...');

            FORM.prepend(BootstrapAlert(response.message, 'success'));

            CarouselDatatable.ajax.reload(null, false);
        },
        error : function(request,error)
        {
            SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', false);

            FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
        }
    });
});

$('#CarouselDatatable tbody').on('click', '.btn-action-edit', function() {
    var CarouselData = CarouselDatatable.row($(this).parents('tr')).data();
    if (CarouselData === undefined) CarouselData = CarouselDatatable.row($(this)).data();
    
    $('#EditCarouselForm').attr('action', CarouselData.update_endpoint);
    $('#EditCarouselForm').attr('method', CarouselData.update_method);
    $('#EditCarouselForm [name="title"]').val(CarouselData.title);
    $('#EditCarouselForm [name="description"]').val(CarouselData.description);
    $('#EditCarouselForm [name="button_text"]').val(CarouselData.button_text);
    $('#EditCarouselForm [name="link"]').val(CarouselData.link);
    $('#EditCarouselImagePreview').attr('src', CarouselData.image_url);
    $('#EditCarouselForm .image-preview-container i, #EditCarouselForm .image-preview-container p').hide();
    $('#EditCarousel').modal('show');
});

$('#CarouselDatatable tbody').on('click', '.btn-action-show', function() {
    var CarouselData = CarouselDatatable.row($(this).parents('tr')).data();
    if (CarouselData === undefined) CarouselData = CarouselDatatable.row($(this)).data();
    
    Swal.fire({
        title: 'Are you sure?',
        text: "You can revert this at any time.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1cc88a',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, do it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : CarouselData.show_endpoint,
                type : CarouselData.show_method,
                success : function(response) {
                    CarouselDatatable.ajax.reload(null, false);
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

$('#CarouselDatatable tbody').on('click', '.btn-action-delete', function() {
    var CarouselData = CarouselDatatable.row($(this).parents('tr')).data();
    if (CarouselData === undefined) CarouselData = CarouselDatatable.row($(this)).data();
    
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
                url : CarouselData.delete_endpoint,
                type : CarouselData.delete_method,
                success : function(response) {
                    CarouselDatatable.ajax.reload(null, false);
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
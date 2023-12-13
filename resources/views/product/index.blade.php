@extends('layouts.dashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">{{ $main_content }}</h6>
        </div>
        <div class="card-body">
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#AddNewProduct"><i class="fas fa-plus"></i>
                Add {{ $main_content }}</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="ProductDatatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="25%">Image</th>
                            <th>Detail</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="AddNewProduct" tabindex="-1" role="dialog" aria-labelledby="AddNewProductLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddNewProductLabel">Add {{ $main_content }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="AddNewProductForm" action="{{ route('product.store') }}" method="POST">
                            <div class="form-group">
                                <div class="image-preview">
                                    <div class="image-preview-container">
                                        <i class="fas fa-file-image"></i>
                                        <p>Gambar produk...</p>
                                        <img id="AddNewProductImagePreview" src="" alt="Product Image">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="AddNewProductImage"
                                        accept="image/png, image/gif, image/jpeg" name="image" required>
                                    <label class="custom-file-label">Pilih file...</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="category">
                                    @foreach ($product_category as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukkan RFID tag" name="tag_id"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukkan nama" name="name"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukkan harga" name="price"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukkan deskripsi"
                                    name="description" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukkan tag" name="tag"
                                    required>
                                <small>*pisahkan dengan koma</small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" form="AddNewProductForm"><i
                                class="fas fa-save mr-2"></i>Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="EditProduct" tabindex="-1" role="dialog" aria-labelledby="EditProductLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditProductLabel">Add {{ $main_content }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="EditProductForm">
                            <div class="form-group">
                                <div class="image-preview">
                                    <div class="image-preview-container">
                                        <i class="fas fa-file-image"></i>
                                        <p>Gambar produk...</p>
                                        <img id="EditProductImagePreview" src="" alt="Product Image">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="EditProductImage"
                                        accept="image/png, image/gif, image/jpeg" name="image">
                                    <label class="custom-file-label">Pilih file...</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="category">
                                    @foreach ($product_category as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukkan RFID tag"
                                    name="tag_id" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukkan nama" name="name"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukkan harga" name="price"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukkan deskripsi"
                                    name="description" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Masukkan tag" name="tag"
                                    required>
                                <small>*pisahkan dengan koma</small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" form="EditProductForm"><i
                                class="fas fa-save mr-2"></i>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var ProductDatatable = $('#ProductDatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.datatable') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'image_preview',
                    name: 'image_preview'
                },
                {
                    data: 'detail',
                    name: 'detail'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });

        $('#AddNewProductImage').on('change', function(e) {
            var Filename = e.target.files[0].name;
            $(this).next('#AddNewProductForm .custom-file-label').text(Filename);

            if (e.target.files && e.target.files[0]) {
                $('#AddNewProductForm .image-preview-container i, #AddNewProductForm .image-preview-container p')
                    .hide();

                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#AddNewProductImagePreview')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(e.target.files[0]);
            }
        });

        $('#EditProductImage').on('change', function(e) {
            var Filename = e.target.files[0].name;
            $(this).next('#EditProductForm .custom-file-label').text(Filename);

            if (e.target.files && e.target.files[0]) {
                $('#EditProductForm .image-preview-container i, #EditProductForm .image-preview-container p')
                    .hide();

                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#EditProductImagePreview')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(e.target.files[0]);
            }
        });

        $('#AddNewProduct').on('hidden.bs.modal', function(e) {
            const MODAL = $(e.currentTarget);

            MODAL.find('form')[0].reset();
            MODAL.find('form .alert').remove();
            MODAL.find('form img').attr('src', '');
            MODAL.find('#AddNewProductForm .custom-file-label').text('Choose file...');

            $('#AddNewProductForm .image-preview-container i, #AddNewProductForm .image-preview-container p')
                .show();
        });

        $('#AddNewProductForm').submit(function(e) {
            e.preventDefault();

            const FORM = $(e.currentTarget);
            const FORM_DATA = new FormData(e.currentTarget);
            const SUBMIT_BUTTON = $(`button[form="${e.currentTarget.id}"]`);
            const LOADING_BUTTON_CONTENT =
                `<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`;
            const SUBMIT_BUTTON_CONTENT = SUBMIT_BUTTON[0].innerHTML;

            SUBMIT_BUTTON[0].innerHTML = LOADING_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', true);

            FORM.find('.alert').remove();

            $.ajax({
                url: FORM.attr('action'),
                type: FORM.attr('method'),
                data: FORM_DATA,
                processData: false,
                contentType: false,
                success: function(response) {
                    SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
                    SUBMIT_BUTTON.prop('disabled', false);

                    FORM[0].reset();
                    FORM.find('.alert').remove();
                    FORM.find('img').attr('src', '');
                    $('#AddNewProduct').find('#AddNewProductForm .custom-file-label').text(
                        'Choose file...');

                    $('#AddNewProductForm .image-preview-container i, #AddNewProductForm .image-preview-container p')
                        .show();

                    FORM.prepend(BootstrapAlert(response.message, 'success'));

                    ProductDatatable.ajax.reload(null, false);
                },
                error: function(request, error) {
                    SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
                    SUBMIT_BUTTON.prop('disabled', false);

                    FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
                }
            });
        });

        $('#EditProduct').on('hidden.bs.modal', function(e) {
            const MODAL = $(e.currentTarget);

            MODAL.find('form .alert').remove();
        });

        $('#EditProductForm').submit(function(e) {
            e.preventDefault();

            const FORM = $(e.currentTarget);
            const FORM_DATA = new FormData(e.currentTarget);
            const SUBMIT_BUTTON = $(`button[form="${e.currentTarget.id}"]`);
            const LOADING_BUTTON_CONTENT =
                `<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`;
            const SUBMIT_BUTTON_CONTENT = SUBMIT_BUTTON[0].innerHTML;

            SUBMIT_BUTTON[0].innerHTML = LOADING_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', true);

            FORM.find('.alert').remove();

            $.ajax({
                url: FORM.attr('action'),
                type: FORM.attr('method'),
                data: FORM_DATA,
                processData: false,
                contentType: false,
                success: function(response) {
                    SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
                    SUBMIT_BUTTON.prop('disabled', false);

                    FORM.find('#AddNewProductForm .custom-file-label').text('Choose file...');

                    FORM.prepend(BootstrapAlert(response.message, 'success'));

                    ProductDatatable.ajax.reload(null, false);
                },
                error: function(request, error) {
                    SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
                    SUBMIT_BUTTON.prop('disabled', false);

                    FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
                }
            });
        });

        $('#ProductDatatable tbody').on('click', '.btn-action-edit', function() {
            var ProductData = ProductDatatable.row($(this).parents('tr')).data();
            if (ProductData === undefined) ProductData = ProductDatatable.row($(this)).data();

            $('#EditProductForm').attr('action', ProductData.update_endpoint);
            $('#EditProductForm').attr('method', ProductData.update_method);
            $('#EditProductForm [name="category"]').val(ProductData.category).change();
            $('#EditProductForm [name="name"]').val(ProductData.name);
            $('#EditProductForm [name="description"]').val(ProductData.description);
            $('#EditProductForm [name="price"]').val(ProductData.price);
            $('#EditProductForm [name="tag"]').val(ProductData.tag);
            $('#EditProductForm [name="tag_id"]').val(ProductData.tag_id);
            $('#EditProductImagePreview').attr('src', ProductData.image_url);
            $('#EditProductForm .image-preview-container i, #EditProductForm .image-preview-container p').hide();
            $('#EditProduct').modal('show');
        });

        $('#ProductDatatable tbody').on('click', '.btn-action-show', function() {
            var ProductData = ProductDatatable.row($(this).parents('tr')).data();
            if (ProductData === undefined) ProductData = ProductDatatable.row($(this)).data();

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
                        url: ProductData.show_endpoint,
                        type: ProductData.show_method,
                        success: function(response) {
                            ProductDatatable.ajax.reload(null, false);
                            Swal.fire('Info', response.message, 'success');
                        },
                        error: function(request, error) {
                            Swal.fire('Info', request.responseJSON.message, 'info');
                        }
                    });
                }
            });
        });

        $('#ProductDatatable tbody').on('click', '.btn-action-delete', function() {
            var ProductData = ProductDatatable.row($(this).parents('tr')).data();
            if (ProductData === undefined) ProductData = ProductDatatable.row($(this)).data();

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
                        url: ProductData.delete_endpoint,
                        type: ProductData.delete_method,
                        success: function(response) {
                            ProductDatatable.ajax.reload(null, false);
                            Swal.fire('Info', response.message, 'success');
                        },
                        error: function(request, error) {
                            Swal.fire('Info', request.responseJSON.message, 'info');
                        }
                    });
                }
            });
        });
    </script>
@endsection

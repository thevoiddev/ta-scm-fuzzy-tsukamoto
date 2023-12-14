@extends('layouts.dashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">{{ $main_content }}</h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center py-3">
                <img src="{{ asset('images/icons/coding.png') }}" alt="Under Development" style="max-width: 25%; opacity: .5">
            </div>
            <h2 class="text-center"><b>Under Development</b></h2>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // var ProductCategoryDatatable = $('#ProductCategoryDatatable').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: "{{ route('product_category.datatable') }}",
        //     columns: [{
        //             data: 'DT_RowIndex',
        //             name: 'DT_RowIndex'
        //         },
        //         {
        //             data: 'name',
        //             name: 'name'
        //         },
        //         {
        //             data: 'action',
        //             name: 'action',
        //             orderable: true,
        //             searchable: true
        //         },
        //     ]
        // });

        // $('#AddProductCategory').on('hidden.bs.modal', function(e) {
        //     const MODAL = $(e.currentTarget);

        //     MODAL.find('form .alert').remove();
        // });

        // $('#EditProductCategory').on('hidden.bs.modal', function(e) {
        //     const MODAL = $(e.currentTarget);

        //     MODAL.find('form .alert').remove();
        // });

        // $('#AddProductCategoryForm').submit(function(e) {
        //     e.preventDefault();

        //     const FORM = $(e.currentTarget);
        //     const SUBMIT_BUTTON = $(`button[form="${e.currentTarget.id}"]`);
        //     const LOADING_BUTTON_CONTENT =
        //         `<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`;
        //     const SUBMIT_BUTTON_CONTENT = SUBMIT_BUTTON[0].innerHTML;

        //     SUBMIT_BUTTON[0].innerHTML = LOADING_BUTTON_CONTENT;
        //     SUBMIT_BUTTON.prop('disabled', true);
        //     FORM.find('.alert').remove();

        //     $.ajax({
        //         url: FORM.attr('action'),
        //         type: FORM.attr('method'),
        //         data: FORM.serialize(),
        //         success: function(response) {
        //             SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
        //             SUBMIT_BUTTON.prop('disabled', false);
        //             FORM[0].reset();
        //             FORM.prepend(BootstrapAlert(response.message, 'success'));

        //             ProductCategoryDatatable.ajax.reload(null, false);
        //         },
        //         error: function(request, error) {
        //             SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
        //             SUBMIT_BUTTON.prop('disabled', false);

        //             FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
        //         }
        //     });
        // });

        // $('#ProductCategoryDatatable tbody').on('click', '.btn-action-edit', function() {
        //     var ProductCategoryData = ProductCategoryDatatable.row($(this).parents('tr')).data();
        //     if (ProductCategoryData === undefined) ProductCategoryData = ProductCategoryDatatable.row($(this))
        //         .data();

        //     $('#EditProductCategoryForm').attr('action', ProductCategoryData.update_endpoint);
        //     $('#EditProductCategoryForm').attr('method', ProductCategoryData.update_method);
        //     $('#EditProductCategoryForm [name="name"]').val(ProductCategoryData.name);
        //     $('#EditProductCategory').modal('show');
        // });

        // $('#EditProductCategoryForm').submit(function(e) {
        //     e.preventDefault();

        //     const FORM = $(e.currentTarget);
        //     const SUBMIT_BUTTON = $(`button[form="${e.currentTarget.id}"]`);
        //     const LOADING_BUTTON_CONTENT =
        //         `<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`;
        //     const SUBMIT_BUTTON_CONTENT = SUBMIT_BUTTON[0].innerHTML;

        //     SUBMIT_BUTTON[0].innerHTML = LOADING_BUTTON_CONTENT;
        //     SUBMIT_BUTTON.prop('disabled', true);
        //     FORM.find('.alert').remove();

        //     $.ajax({
        //         url: FORM.attr('action'),
        //         type: FORM.attr('method'),
        //         data: FORM.serialize(),
        //         success: function(response) {
        //             SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
        //             SUBMIT_BUTTON.prop('disabled', false);

        //             FORM.prepend(BootstrapAlert(response.message, 'success'));

        //             ProductCategoryDatatable.ajax.reload(null, false);
        //         },
        //         error: function(request, error) {
        //             SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
        //             SUBMIT_BUTTON.prop('disabled', false);

        //             FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
        //         }
        //     });
        // });

        // $('#ProductCategoryDatatable tbody').on('click', '.btn-action-delete', function() {
        //     var ProductCategoryData = ProductCategoryDatatable.row($(this).parents('tr')).data();
        //     if (ProductCategoryData === undefined) ProductCategoryData = ProductCategoryDatatable.row($(this))
        //         .data();

        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#1cc88a',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 url: ProductCategoryData.delete_endpoint,
        //                 type: ProductCategoryData.delete_method,
        //                 success: function(response) {
        //                     ProductCategoryDatatable.ajax.reload(null, false);
        //                     Swal.fire('Info', response.message, 'success');
        //                 },
        //                 error: function(request, error) {
        //                     Swal.fire('Info', request.responseJSON.message, 'info');
        //                 }
        //             });
        //         }
        //     });
        // });
    </script>
@endsection

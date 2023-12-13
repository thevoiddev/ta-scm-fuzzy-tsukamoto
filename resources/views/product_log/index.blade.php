@extends('layouts.dashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">{{ $main_content }}</h6>
        </div>
        <div class="card-body">
            @if (session('user')['userable_type'] == App\Models\UserBusiness::class &&
                    App\Models\UserBusiness::find(session('user')['userable_id'])->role == 'PRODUSEN')
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#AddProductLog"><i
                        class="fas fa-plus mr-2"></i> Add {{ $main_content }}</button>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="ProductLogDatatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Title</th>
                            <th>Items</th>
                            <th>Distibutor</th>
                            <th>Agent</th>
                            <th>Status</th>
                            @if (session('user')['userable_type'] == App\Models\UserBusiness::class &&
                                    App\Models\UserBusiness::find(session('user')['userable_id'])->role == 'DISTRIBUTOR')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="AddProductLog" tabindex="-1" role="dialog" aria-labelledby="AddProductLogLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddProductLogLabel">Add {{ $main_content }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="AddProductLogForm" action="{{ route('product_log.store') }}" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Judul Pengiriman" name="title"
                                    required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="distributor">
                                    @foreach ($distributor as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="agent">
                                    @foreach ($agent as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <div class="form-group">
                                <select class="form-control" name="product">
                                    @foreach ($product as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-10">
                                    <input type="text" class="form-control" placeholder="Jumlah" name="amount">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="AddMuatan"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <hr>
                            <p><b>Muatan Pengiriman : </b></p>
                            <div id="Muatan">

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" form="AddProductLogForm"><i
                                class="fas fa-save mr-2"></i>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var ProductLogDatatable = $('#ProductLogDatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product_log.datatable') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'f_items',
                    name: 'f_items'
                },
                {
                    data: 'distributor',
                    name: 'distributor'
                },
                {
                    data: 'agent',
                    name: 'agent'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                @if (session('user')['userable_type'] == App\Models\UserBusiness::class &&
                        App\Models\UserBusiness::find(session('user')['userable_id'])->role == 'DISTRIBUTOR')
                    {
                        data: 'action',
                        name: 'action'
                    },
                @endif
            ]
        });

        @if (session('user')['userable_type'] == App\Models\UserBusiness::class &&
                App\Models\UserBusiness::find(session('user')['userable_id'])->role == 'DISTRIBUTOR')
            $('#ProductLogDatatable tbody').on('click', '.btn-action-send', function() {
                var DataData = ProductLogDatatable.row($(this).parents('tr')).data();
                if (DataData === undefined) DataData = ProductLogDatatable.row($(this)).data();

                Swal.fire({
                    title: 'Yakin ingin mengirim paket ini?',
                    text: "Aksi ini tidak dapat dibatalkan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, kirim!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: DataData.send_endpoint,
                            type: DataData.send_method,
                            success: function(response) {
                                ProductLogDatatable.ajax.reload(null, false);
                                Swal.fire('Info', response.message, 'success');
                            },
                            error: function(request, error) {
                                Swal.fire('Info', request.responseJSON.message, 'info');
                            }
                        });
                    }
                });
            });
        @endif

        $('#AddProductLog').on('hidden.bs.modal', function(e) {
            const MODAL = $(e.currentTarget);

            MODAL.find('form .alert').remove();
        });

        $('#EditProductLog').on('hidden.bs.modal', function(e) {
            const MODAL = $(e.currentTarget);

            MODAL.find('form .alert').remove();
        });

        $('#AddProductLogForm').submit(function(e) {
            e.preventDefault();

            if ($('#Muatan .form-group').length == 0) return;

            const FORM = $(e.currentTarget);
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
                data: FORM.serialize(),
                success: function(response) {
                    SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
                    SUBMIT_BUTTON.prop('disabled', false);
                    FORM[0].reset();
                    FORM.prepend(BootstrapAlert(response.message, 'success'));

                    ProductLogDatatable.ajax.reload(null, false);
                    $('#Muatan').html(``);
                },
                error: function(request, error) {
                    SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
                    SUBMIT_BUTTON.prop('disabled', false);

                    FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
                }
            });
        });

        $('#AddMuatan').click(function(e) {
            e.preventDefault();
            if ($('[name="amount"]').val() > 01) {
                if ($(`#Muatan [value="${$('[name="product"]').val()}"]`).length == 0) {
                    $('#Muatan').append(`<div class="form-group row">
                            <input type="hidden" name="items[]" value="${$('[name="product"]').val()}">
                            <div class="col-8">
                                <input type="text" class="form-control" value="${$('[name="product"] option:selected').text()}" required readonly>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" name="amounts[]" value="${$('[name="amount"]').val()}" required readonly>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-danger delete-muatan" type="button"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>`);
                }
            }
        });

        $(document).on('click', '.delete-muatan', function(e) {
            e.preventDefault();
            $(this).closest('.form-group').remove();
        })
    </script>
@endsection

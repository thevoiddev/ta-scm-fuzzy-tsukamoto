@extends('layouts.dashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">{{ $main_content }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="DataDatatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Usaha</th>
                            <th>Jabatan</th>
                            <th>Cabang</th>
                            {{-- <th width="10%">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="AddData" tabindex="-1" role="dialog" aria-labelledby="AddDataLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddDataLabel">Tambah {{ $main_content }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="AddDataForm" action="{{ route('business.store') }}" method="POST">
                            <div class="form-group w-50">
                                <select class="form-control" id="BusinessType" name="type">
                                    <option selected disabled>--- Tipe Usaha ---</option>
                                    <option name="PRODUSEN">PRODUSEN</option>
                                    <option name="DISTRIBUTOR">DISTRIBUTOR</option>
                                    <option name="AGEN">AGEN</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nama Usaha" name="name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email Pemilik" name="email"
                                    required>
                            </div>
                            <div id="AgentInput">
                                <hr>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nama Toko" name="store_name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Alamat Toko"
                                        name="store_address">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nama Gudang"
                                        name="warehouse_name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Alamat Gudang"
                                        name="warehouse_address">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" form="AddDataForm"><i
                                class="fas fa-save mr-2"></i>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var DataDatatable = $('#DataDatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.datatable') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'business',
                    name: 'business'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'office',
                    name: 'office'
                },
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: true,
                //     searchable: true
                // }
            ]
        });

        $('#AddData').on('hidden.bs.modal', function(e) {
            const MODAL = $(e.currentTarget);

            MODAL.find('form .alert').remove();
        });

        $('#AddDataForm').submit(function(e) {
            e.preventDefault();

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

                    DataDatatable.ajax.reload(null, false);
                    $('#AgentInput').hide();
                },
                error: function(request, error) {
                    SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
                    SUBMIT_BUTTON.prop('disabled', false);

                    FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
                }
            });
        });

        $('#DataDatatable tbody').on('click', '.btn-action-edit', function() {
            var DataData = DataDatatable.row($(this).parents('tr')).data();
            if (DataData === undefined) DataData = DataDatatable.row($(this)).data();
        });
    </script>
@endsection

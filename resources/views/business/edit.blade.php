@extends('layouts.dashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Data {{ $main_content }}</h6>
        </div>
        <div class="card-body">
            <form id="DataForm" action="{{ route('business.update', $business->slug) }}" method="POST">
                <div class="form-row mb-3">
                    <div class="col">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" placeholder="Nama Usaha" name="name"
                            value="{{ $business->name }}" required>
                    </div>
                    <div class="col">
                        <label for="">Tipe</label>
                        <select class="form-control" id="BusinessType" name="type">
                            <option selected disabled>--- Tipe Usaha ---</option>
                            <option name="PRODUSEN" {{ $business->role == 'PRODUSEN' ? 'selected' : '' }}>PRODUSEN</option>
                            <option name="DISTRIBUTOR" {{ $business->role == 'DISTRIBUTOR' ? 'selected' : '' }}>DISTRIBUTOR
                            </option>
                            <option name="AGEN" {{ $business->role == 'AGEN' ? 'selected' : '' }}>AGEN</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-save mr-2"></i>Simpan</button>
                <a type="button" class="btn btn-secondary float-right mr-2" href="{{ route('business.index') }}"><i
                        class="fas fa-chevron-left mr-2"></i>Kembali</a>
            </form>
        </div>
    </div>
    @if ($business->role == 'AGEN')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Data Cabang {{ $main_content }}</h6>
            </div>
            <div class="card-body">
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#AddOffice"><i
                        class="fas fa-plus mr-2"></i> Tambah Cabang</button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="OfficeDatatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Cabang</th>
                                <th>Alamat</th>
                                <th>Tipe</th>
                                {{-- <th width="10%">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Data Pegawai {{ $main_content }}</h6>
            </div>
            <div class="card-body">
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#AddEmployee"><i
                        class="fas fa-plus mr-2"></i> Tambah Pegawai</button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="EmployeeDatatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Cabang</th>
                                {{-- <th width="10%">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Data Perangkat Keras {{ $main_content }}</h6>
            </div>
            <div class="card-body">
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#AddScanner"><i
                        class="fas fa-plus mr-2"></i> Tambah Perangkat</button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="ScannerDatatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Cabang</th>
                                {{-- <th width="10%">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Scanner --}}
        <div class="modal fade" id="AddScanner" tabindex="-1" role="dialog" aria-labelledby="AddScannerLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddScannerLabel">Tambah Perangkat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="AddScannerForm" action="{{ route('business.store_scanner') }}" method="POST">
                            <div class="form-group">
                                <select class="form-control" name="office">
                                    @foreach ($office as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nama Perangkat" name="name"
                                    required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" form="AddScannerForm"><i
                                class="fas fa-save mr-2"></i>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Scanner --}}
        {{-- Office --}}
        <div class="modal fade" id="AddOffice" tabindex="-1" role="dialog" aria-labelledby="AddOfficeLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddOfficeLabel">Tambah Cabang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="AddOfficeForm" action="{{ route('business.store_office') }}" method="POST">
                            <input type="hidden" name="business" value="{{ $business->slug }}">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nama Cabang" name="name"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Alamat Cabang" name="address">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="role">
                                    <option value="TOKO">Toko</option>
                                    <option value="GUDANG">Gudang</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" form="AddOfficeForm"><i
                                class="fas fa-save mr-2"></i>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Office --}}
        {{-- Employee --}}
        <div class="modal fade" id="AddEmployee" tabindex="-1" role="dialog" aria-labelledby="AddEmployeeLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddEmployeeLabel">Tambah Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="AddEmployeeForm" action="{{ route('business.store_employee') }}" method="POST">
                            <input type="hidden" name="business" value="{{ $business->slug }}">
                            <div class="form-group">
                                <select class="form-control" name="office">
                                    @foreach ($office as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="role">
                                    @foreach ($role as $item)
                                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nama Pegawai" name="name"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email Pegawai" name="email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username Pegawai"
                                    name="username">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" form="AddEmployeeForm"><i
                                class="fas fa-save mr-2"></i>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Employee --}}
    @endif
@endsection

@section('script')
    <script>
        var OfficeDatatable = $('#OfficeDatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('business.office_datatable', $business->slug) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: true,
                //     searchable: true
                // }
            ]
        });

        var EmployeeDatatable = $('#EmployeeDatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('business.employee_datatable', $business->slug) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
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

        var ScannerDatatable = $('#ScannerDatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('business.scanner_datatable', $business->slug) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
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

        // Business
        $('#DataForm').submit(function(e) {
            e.preventDefault();

            const FORM = $(e.currentTarget);
            const FORM_DATA = new FormData(e.currentTarget);
            const SUBMIT_BUTTON = FORM.find('button[type="submit"]');
            const LOADING_BUTTON_CONTENT =
                `<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`;
            const SUBMIT_BUTTON_CONTENT = SUBMIT_BUTTON[0].innerHTML;

            SUBMIT_BUTTON[0].innerHTML = LOADING_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', true);

            $.ajax({
                url: FORM.attr('action'),
                type: FORM.attr('method'),
                data: FORM_DATA,
                processData: false,
                contentType: false,
                success: function(response) {
                    SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
                    SUBMIT_BUTTON.prop('disabled', false);

                    Swal.fire('Info', response.message, 'success').then(() => {
                        window.location = response.url;
                    });
                },
                error: function(request, error) {
                    SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
                    SUBMIT_BUTTON.prop('disabled', false);

                    Swal.fire('Info', request.responseJSON.message, 'info');
                }
            });
        });

        // Scanner
        $('#AddScannerForm').submit(function(e) {
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

                    Swal.fire('Info', response.message, 'success');

                    ScannerDatatable.ajax.reload(null, false);

                    $('#AddScanner').modal('hide');
                },
                error: function(request, error) {
                    SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
                    SUBMIT_BUTTON.prop('disabled', false);

                    FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
                }
            });
        });

        // Office
        $('#AddOfficeForm').submit(function(e) {
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

                    Swal.fire('Info', response.message, 'success');

                    OfficeDatatable.ajax.reload(null, false);

                    $('#AddOffice').modal('hide');
                },
                error: function(request, error) {
                    SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
                    SUBMIT_BUTTON.prop('disabled', false);

                    FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
                }
            });
        });

        // Employee
        $('#AddEmployeeForm').submit(function(e) {
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

                    Swal.fire('Info', response.message, 'success');

                    OfficeDatatable.ajax.reload(null, false);

                    $('#AddEmployee').modal('hide');
                },
                error: function(request, error) {
                    SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
                    SUBMIT_BUTTON.prop('disabled', false);

                    FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
                }
            });
        });
    </script>
@endsection

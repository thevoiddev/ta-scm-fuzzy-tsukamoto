@extends('layouts.dashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">{{ $main_content }}</h6>
        </div>
        <div class="card-body">
            <form id="DataForm" action="{{ route('profile.update') }}" method="POST">
                <div class="form-row mb-3">
                  <div class="col">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" placeholder="Nama Pengguna" name="name" value="{{ session('user')['name'] }}" required>
                  </div>
                  <div class="col">
                    <label for="">Username</label>
                    <input type="text" class="form-control" placeholder="Username Pengguna" name="username" value="{{ session('user')['username'] }}" required>
                  </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col">
                        <label for="">Email</label>
                        <input type="text" class="form-control" placeholder="Email Pengguna" name="email" value="{{ session('user')['email'] }}" required>
                    </div>
                    <div class="col">
                      <label for="">Password</label>
                      <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control" placeholder="Masukkan Password" name="password">
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password" data-input="#password"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-save mr-2"></i>Simpan</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
$('#DataForm').submit(function(e){
    e.preventDefault();
    
    const FORM = $(e.currentTarget);
    const FORM_DATA = new FormData(e.currentTarget);
    const SUBMIT_BUTTON = FORM.find('button[type="submit"]');
    const LOADING_BUTTON_CONTENT = `<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`;
    const SUBMIT_BUTTON_CONTENT = SUBMIT_BUTTON[0].innerHTML;

    SUBMIT_BUTTON[0].innerHTML = LOADING_BUTTON_CONTENT;
    SUBMIT_BUTTON.prop('disabled', true);

    $.ajax({
        url : FORM.attr('action'),
        type : FORM.attr('method'),
        data : FORM_DATA,
        processData: false,
        contentType: false,
        success : function(response) {   
            SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', false);

            Swal.fire('Info', response.message, 'success').then(() => {
                location.reload();
            });
        },
        error : function(request,error)
        {
            SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', false);

            Swal.fire('Info', request.responseJSON.message, 'info');
        }
    });
});
</script>
@endsection
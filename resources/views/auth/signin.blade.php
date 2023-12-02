@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5 mx-auto" style="width: 450px; max-width: 90%">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <img src="{{ asset('images/logo/'.$web_information->logo_main) }}" alt="" class="mb-3" style="max-width: 125px">
                            </div>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-0"><b>Selamat Datang</b></h1>
                                <p class="mb-4">Silahkan masuk untuk mengakses fitur yang tersedia di website ini.</p>
                            </div>
                            <form id="SigninForm" action="{{ route('auth.signin') }}" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter username" required name="username">
                                </div>
                                <div class="input-group mb-3">
                                    <input id="password" type="password" class="form-control" placeholder="Enter password" required name="password">
                                    <div class="input-group-append">
                                        <span class="input-group-text toggle-password" data-input="#password"><i class="fas fa-eye"></i></span>
                                    </div>
                                </div>
                                <button class="btn btn-success btn-block" type="submit">
                                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$('#SigninForm').submit(function(e){
    e.preventDefault();
    
    const FORM = $(e.currentTarget);
    const SUBMIT_BUTTON = FORM.find('button[type="submit"]');
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

            FORM.prepend(BootstrapAlert(response.message, 'success'));

            var TimeLeft = 4;
            var RedirectInterval = setInterval(function(){
                if(TimeLeft <= 0){
                    clearInterval(RedirectInterval);
                    window.location.href = response.redirect;
                }
                $("#RedirectCountdown").text(TimeLeft);
                TimeLeft -= 1;
            }, 1000);
        },
        error : function(request,error)
        {
            SUBMIT_BUTTON[0].innerHTML = SUBMIT_BUTTON_CONTENT;
            SUBMIT_BUTTON.prop('disabled', false);

            FORM.prepend(BootstrapAlert(request.responseJSON.message, 'warning'));
        }
    });
});
</script>
@endsection
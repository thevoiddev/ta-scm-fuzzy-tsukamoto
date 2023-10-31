@extends('layouts.dashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">{{ $main_content }}</h6>
        </div>
        <div class="card-body">
            <form id="WebInformationForm" action="{{ route('web_information.update') }}" method="POST">
                <div class="form-row mb-3">
                  <div class="col">
                    <label for="">Title</label>
                    <input type="text" class="form-control" placeholder="Website title" name="title" value="{{ $web_information->title }}">
                  </div>
                  <div class="col">
                    <label for="">Keywords</label>
                    <input type="text" class="form-control" placeholder="Website keywords" name="keywords" value="{{ implode(',', json_decode($web_information->keywords)) }}">
                  </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-6">
                        <label for="">Author</label>
                        <input type="text" class="form-control" placeholder="Website author" name="author" value="{{ $web_information->author }}">
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col">
                        <label for="">Description (SEO)</label>
                        <textarea class="form-control" placeholder="Website description for SEO" name="description" rows="5">{{ $web_information->description }}</textarea>
                    </div>
                    <div class="col">
                      <label for="">Long Description</label>
                      <textarea class="form-control" placeholder="Website description" name="long_description" rows="5">{{ $web_information->long_description }}</textarea>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col">
                        <label for="">Email</label>
                        <input type="text" class="form-control" placeholder="Contact email" name="email" value="{{ $web_information->email }}">
                    </div>
                    <div class="col">
                      <label for="">Phone</label>
                      <input type="text" class="form-control" placeholder="Contact phone" name="phone" value="{{ $web_information->phone }}">
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-6">
                        <div class="image-preview">
                            <div>
                                @if($web_information->logo_main)
                                    <img id="LogoPrimaryPreview" src="{{ asset('images/logo/'.$web_information->logo_main) }}" alt="Logo Primary">
                                @else
                                    <i class="fas fa-file-image"></i>
                                    <p>Upload an image</p>
                                    <img id="LogoPrimaryPreview" src="" alt="Logo Primary">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="image-preview image-secondary">
                            <div>
                                @if($web_information->logo_secondary)
                                    <img id="LogoSecondaryPreview"  src="{{ asset('images/logo/'.$web_information->logo_secondary) }}" alt="Logo Primary">
                                @else
                                    <i class="fas fa-file-image"></i>
                                    <p>Upload an image</p>
                                    <img id="LogoSecondaryPreview" src="" alt="Logo Secondary">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-6">
                        <label for="">Logo Primary</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="LogoPrimary" accept="image/png, image/gif, image/jpeg" name="logo_primary">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="">Logo Secondary</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="LogoSecondary" accept="image/png, image/gif, image/jpeg" name="logo_secondary">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-6">
                        <div class="image-preview">
                            <div>
                                @if($web_information->favicon)
                                    <img id="FaviconPreview" src="{{ asset('images/logo/'.$web_information->favicon) }}" alt="Faviocn">
                                @else
                                    <i class="fas fa-file-image"></i>
                                    <p>Upload an image</p>
                                    <img id="FaviconPreview" src="" alt="Favicon">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-6">
                        <label for="">Favicon</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="Favicon" accept="image/png, image/gif, image/jpeg" name="favicon">
                            <label class="custom-file-label">Choose file...</label>
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
$('#LogoPrimary').on('change', function(e){
    var Filename = e.target.files[0].name;
    $(this).next('.custom-file-label').text(Filename);

    if (e.target.files && e.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#LogoPrimaryPreview')
                .attr('src', e.target.result);
        };
        
        reader.readAsDataURL(e.target.files[0]);
    }
});

$('#LogoSecondary').on('change', function(e){
    var Filename = e.target.files[0].name;
    $(this).next('.custom-file-label').text(Filename);

    if (e.target.files && e.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#LogoSecondaryPreview')
                .attr('src', e.target.result);
        };
        
        reader.readAsDataURL(e.target.files[0]);
    }
});

$('#Favicon').on('change', function(e){
    var Filename = e.target.files[0].name;
    $(this).next('.custom-file-label').text(Filename);

    if (e.target.files && e.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#FaviconPreview')
                .attr('src', e.target.result);
        };
        
        reader.readAsDataURL(e.target.files[0]);
    }
});

$('#WebInformationForm').submit(function(e){
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

            Swal.fire('Info', response.message, 'success');
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
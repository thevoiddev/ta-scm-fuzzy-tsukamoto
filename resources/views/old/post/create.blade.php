@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('post.index') }}"><button class="btn btn-success mb-3"><i class="fas fa-chevron-left mr-2"></i>Back</button></a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Create {{ $main_content }}</h6>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-row mb-3">
                    <div class="col">
                      <label for="">Title</label>
                      <input type="text" class="form-control" placeholder="Website title" name="title">
                    </div>
                    <div class="col">
                      <label for="">Keywords</label>
                      <input type="text" class="form-control" placeholder="Website keywords" name="keywords">
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col">
                      <label for="">Description</label>
                      <textarea name="" id="" cols="30" rows="4" class="form-control" style="height: 125px; resize: none"></textarea>
                    </div>
                    <div class="col">
                        <label for="">Thumbnail Preview</label>
                        <div class="image-preview mt-0">
                            <div>
                                <i class="fas fa-file-image hide-on-preview"></i>
                                <p class="hide-on-preview">Upload an image</p>
                                <img id="ThumbnailPreview" src="" alt="Logo Primary">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col">
                        <label for="">Post Category</label>
                        <select class="form-control">
                            @foreach ($post_category as $item)
                                <option value="{{ str_encrypt($item->id) }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                      </div>
                    <div class="col-6">
                        <label for="">Thumbnail File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="Thumbnail" accept="image/png, image/gif, image/jpeg" name="logo_secondary">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                </div>
                <textarea name="" id="ckeditor" cols="30" rows="10"></textarea>
                <button class="btn btn-success mt-3 float-right"><i class="fas fa-save mr-2"></i>Publish</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>
@include('ckfinder::setup')
<script>
    ClassicEditor
        .create( document.querySelector( '#ckeditor' ), {
            ckfinder: {
                uploadUrl: "{{ route('ckeditor.upload').'?_token='.csrf_token().'&command=QuickUpload&type=Files&responseType=json' }}",
            }
        } )
        .catch( error => {
            console.error( error );
        } );

    $('#Thumbnail').on('change', function(e){
        var Filename = e.target.files[0].name;
        $(this).next('.custom-file-label').text(Filename);

        if (e.target.files && e.target.files[0]) {
            var reader = new FileReader();

            $('.hide-on-preview').hide();

            reader.onload = function (e) {
                $('#ThumbnailPreview')
                    .attr('src', e.target.result);
            };
            
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script> --}}
@endsection
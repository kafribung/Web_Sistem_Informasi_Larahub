@extends('layouts.master')
@section('title', 'Forum Laravel')
@section('content')

<div class="container">
    <section class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="/pertanyaan" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Pertanyaan</label>
                            <textarea name="description" id="" class="form-control ckeditor @error('description') is-invalid @enderror" placeholder="Tulis Pertanyaan">{{old('description')}}</textarea>

                            @error('description')
                                <p class="alert alert-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-sm float-right">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@push('after_script')
    <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
    <script>
        var options = {
          filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
          filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
          filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
          filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
      </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '.ckeditor' ), options)
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
        } );
    </script>
@endpush
@endsection
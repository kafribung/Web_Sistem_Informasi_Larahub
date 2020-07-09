@extends('layouts.master')
@section('title', 'Edit Jawaban Stack Lara')
@section('content')

<div class="container">
    <section class="row">
        <div class="col-sm-12 mt-4 mb-3 text-center">
            <h3>Edit Jawaban<span class="badge badge-warning">Stack Lara</span></h3>
            <a href="/">Kambali ke Home</a>
        </div>

        <div class="col-sm-12 mb-3">
            <div class="card border-info">
                <div class="card-body">
                    <form action="/jawaban/{{ $jawaban->id }}" method="POST">
                        @csrf
                        @method('PUT')
                       
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="my-editor" class="form-control  @error('description') is-invalid @enderror" placeholder="Tulis jawaban">{{ old('description') ? old('description') : $jawaban->description }}</textarea>

                            @error('description')
                                <p class="alert alert-danger">{{$message}}</p>
                            @enderror
                        </div>
                       
                        <button class="btn btn-warning btn-block btn-sm float-right">Update Jawaban</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@push('after_script')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    </script>

    <script>
        CKEDITOR.replace('description', options);
    </script>
@endpush
@endsection
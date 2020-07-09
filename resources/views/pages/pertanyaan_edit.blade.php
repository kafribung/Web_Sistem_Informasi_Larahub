@extends('layouts.master')
@section('title', 'Edit Pertanyaan Stack Lara')
@section('content')

<div class="container">
    <section class="row">
        <div class="col-sm-12 mt-4 mb-3 text-center">
            <h3>Edit Pertanyaan<span class="badge badge-warning">Stack Lara</span></h3>
            <a href="/">Kambali ke Home</a>
        </div>

        <div class="col-sm-12 mb-3">
            <div class="card border-info">
                <div class="card-body">
                    <form action="/pertanyaan/{{ $pertanyaan->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input name="title" type="text" class="form-control   @error('title') is-invalid @enderror"  autofocus autocomplete="off" placeholder="Judul Pertanyaan" value="{{ old('title') ? old('title') : $pertanyaan->title }}">

                            @if ($errors->has('title'))
                                <p class="alert alert-danger">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="my-editor" class="form-control  @error('description') is-invalid @enderror" placeholder="Tulis Pertanyaan">{{ old('description') ? old('description') : $pertanyaan->description }}</textarea>

                            @error('description')
                                <p class="alert alert-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tag">Tag</label>
                            <input name="tag" type="text" class="form-control   @error('tag') is-invalid @enderror"   autocomplete="off" placeholder="Masukkan Tag" value="{{ old('tag') ? old('tag') : $pertanyaan->tag }}">

                            @error('tag')
                                <p class="alert alert-danger">{{$message}}</p>
                            @enderror
                            
                        </div>
                        <button class="btn btn-warning btn-block btn-sm float-right">Update Pertanyaan</button>
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
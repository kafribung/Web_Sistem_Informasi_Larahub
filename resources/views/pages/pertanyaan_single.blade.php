@extends('layouts.master')
@section('title', 'Forum Laravel')
@section('content')

<div class="container">

    <section class="row">
        <div class="col-sm-12 mt-4 mb-3 text-center">
            <h3>Forum Pertanyaan<span class="badge badge-dark">Stack Lara</span></h3>
        </div>

        {{-- Detail Pertanyaan --}}
        <div class="col-sm-12 mb-4">
            <div class="card border-dark">
                <div class="card-body">
                    <h6>Penanya : {{$pertanyaan->user->name}}</h6>
                    <P class="badge badge-info">{{ $pertanyaan->tag }}</P>

                    <h4>{{ $pertanyaan->title }}</h4>
                    <div>
                        {!!  $pertanyaan->description !!}
                    </div>
                </div>

                <div class="card-footer">
                    <i>Ditanyakan tgl : {{$pertanyaan->created_at->format('d-m-Y : h:i:sa')}}</i>
                </div>
            </div>
        </div>

        {{-- Semua Jawaban --}}
        <div class="col-sm-12">
            @forelse ($pertanyaan->jawabans as $jawaban)
            <div class="card border-info mb-3">
                <div class="card-footer">
                    <h5>Jawaban : {{$jawaban->user->name}}</h5>
                    <div>
                        {!! $jawaban->description !!}
                    </div>
                </div>
            </div>
        @empty
        <div class="card border-info mb-3">
            <div class="card-footer">
                <h5>Belum ada jawaban</h5>
            </div>
        </div>
        @endforelse
        </div>

         {{-- Create Pertayaan --}}
        <div class="col-sm-12 mb-3">
            @if (!$pertanyaan->author())
            <div class="card border-info">
                <div class="card-body">
                    <h4>Jawab Pertanyaan</h4>
                    <form action="/jawaban/{{$pertanyaan->id}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Jawaban</label>
                            <textarea name="description" id="my-editor" class="form-control  @error('description') is-invalid @enderror" placeholder="Tulis Pertanyaan">{{old('description')}}</textarea>

                            @error('description')
                                <p class="alert alert-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-block btn-sm float-right">Jawab</button>
                    </form>
                </div>
            </div>
        </div>
        @endif


        
        
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
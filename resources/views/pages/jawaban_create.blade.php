@extends('layouts.master')
@section('title', 'Jawab Pertanyaan Forum Laravel')
@section('content')

<div class="container">

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <section class="row">
        <div class="col-sm-12">

            <div class="card border-dark mb-3">
                <div class="card-body">
                    <h5>Penanya : {{$pertanyaan->user->name}}</h5>
                    <div>
                        {!! $pertanyaan->description !!}
                    </div>
                </div>

                <div class="card-footer">
                    <i>Ditanyakan tgl : {{$pertanyaan->created_at->format('d-m-Y : h:i:sa')}}</i>
                    
                </div>
            </div>

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
                
            @endforelse

            <hr>

            {{-- Create Pertayaan --}}
            <div class="card border-info">
                <div class="card-body">
                    <h1>Jawab Pertanyaan</h1>
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
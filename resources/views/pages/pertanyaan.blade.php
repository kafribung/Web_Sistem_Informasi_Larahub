@extends('layouts.master')
@section('title', 'Forum Tanya Jawab Stack Laravel')
@section('content')

<div class="container">

    @if (session('status'))
    <p class="alert alert-success" role="alert">
        {{ session('status') }}
    </p>
    @endif
    <section class="row">
        <div class="col-sm-12 mt-4 mb-3 text-center">
            <h3>Forum Pertanyaan<span class="badge badge-info">Stack Lara</span></h3>
            <a href="/pertanyaan/create" class="btn btn-primary btn-sm float-right p-1 ">Buat Pertanyaan</a>
        </div>

        @forelse ($pertanyaans as $pertanyaan)
        <div class="col-sm-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h6>Penanya : {{$pertanyaan->user->name}}</h6>
                    <h4><a href="/pertanyaan/{{$pertanyaan->slug}}">{{ $pertanyaan->title }}</a></h4>
                    <div>
                        {!! Str::limit( $pertanyaan->description, 200, '...') !!}
                    </div>
                    <P class="badge badge-info">{{ $pertanyaan->tag }}</P>
                </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
                    0
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
                    @if ($pertanyaan->author())
                    <a href="/pertanyaan/{{$pertanyaan->slug}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

                    <form action="/pertanyaan/{{$pertanyaan->id}}" method="POST" class="d-inline-flex">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
                    @endif

                </div>
            </div>
        </div>
        @empty
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>Belum ada pertanyaan</h5>
                </div>
            </div>
        </div>
        @endforelse

    </section>
</div>


@endsection

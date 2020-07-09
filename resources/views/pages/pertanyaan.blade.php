@extends('layouts.master')
@section('title', 'Forum Laravel')
@section('content')

<div class="container">

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
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
                    <h5>Penanya : {{$pertanyaan->user->name}}</h5>
                    <div>
                        {!! $pertanyaan->description !!}
                    </div>
                </div>

                <div class="card-footer">
                    @if ($pertanyaan->author())
                    <a href="/pertanyaan/{{$pertanyaan->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="/pertanyaan/{{$pertanyaan->id}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                    <form action="/pertanyaan/{{$pertanyaan->id}}" method="POST" class="d-inline-flex">
                        @csrf
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>

                    @else
                    <a href="/pertanyaan/{{$pertanyaan->id}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="/jawaban/{{$pertanyaan->id}}" class="btn btn-info btn-sm"><i class="fa fa-reply"></i></a>
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

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
        <div class="col-sm-12">
            <h3>Forum Pertanyaan</h3>
            <a href="/pertanyaan/create" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i></a>
        </div>

        @forelse ($pertanyaans as $pertanyaan)

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>Penanya : {{$pertanyaan->user->name}}</h5>
                    <div>
                        {!! $pertanyaan->description !!}
                    </div>
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
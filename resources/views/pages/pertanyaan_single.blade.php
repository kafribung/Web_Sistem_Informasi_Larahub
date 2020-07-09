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
            <h3>Forum Pertanyaan<span class="badge badge-dark">Stack Lara</span></h3>
        </div>

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
        
    </section>
</div>


@endsection
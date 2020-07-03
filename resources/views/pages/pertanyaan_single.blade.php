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
            <h3>Detail Pertanyaan</h3>
        </div>

        <div class="col-sm-12 mb-4">
            <div class="card border-dark">
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
        </div>
        
    </section>
</div>


@endsection
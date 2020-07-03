@extends('layouts.master')
@section('title', 'Forum Laravel')
@section('content')

<div class="container">
    <section class="row">
        <div class="col-sm-12">
            <h3>Forum Pertanyaan</h3>
            <a href="/pertanyaan/create" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i></a>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>Nama</h5>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque, eius.</p>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
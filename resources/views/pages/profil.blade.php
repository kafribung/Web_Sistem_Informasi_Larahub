@extends('layouts.master')
@section('title', 'Forum Tanya Jawab Stack Laravel')
@section('content')

<div class="container">
    @if (session('status'))
    <p class="alert alert-success" role="alert">
        {{ session('status') }}
    </p>
    @endif

    <div class="card shadow mb-4" style="margin-top: 2%">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
        </div>
        <form role="form" method="POST" action="profil/{{$profil->id}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly value="{{ Auth::user()->email }}">
                </div>
                <div class="form-group">
                    <label for="fullname">Nama Lengkap</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nama Lengkap" value="{{$profil->fullname}}">
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea class="form-control" rows="3" id="address" name="address" >{{$profil->address}}</textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
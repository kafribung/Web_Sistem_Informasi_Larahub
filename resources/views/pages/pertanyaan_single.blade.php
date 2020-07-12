@extends('layouts.master')
@section('title', 'Forum Laravel')
@section('content')

<div class="container">

    @if (session('status'))
    <p class="alert alert-success" role="alert" style="align-content: center">
        {{ session('status') }}
    </p>
    @endif

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
                
                    {{-- komentar Tanya --}}
                    <div id="accordion">
                        <div class="card border-dark ">
                            <div class="card-header" class="collapsed card-link" data-toggle="collapse" href="#listtanya-{{$pertanyaan->id}}">
                            Komentar
                            </a>
                            </div>
                            <div id="listtanya-{{$pertanyaan->id}}" class="collapse" data-parent="#accordion">

                                {{-- Looping Komentar Tanya --}}
                                @foreach ($pertanyaan->komen_tanyas as $komen)
                                <div class="card-body">
                                    <div class="col-sm-12" >
                                        <div class="card border-dark">
                                            <div class="card-body">
                                                <h6>Komentar dari : <label id="userkomentanya-{{$komen->id}}"> {{$komen->user->name}}</label></h6>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label id="komendesctanya-{{$komen->id}}"> {!! $komen->description !!}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Owner Edit Delete Komen --}}
                                        @if ($komen->author())
                                        <div class="card-footer">
                                            {{-- <button><a href="/komentanya/{{ $komen->id  }}/edit">Edit</a></button> --}}
                                            <button type="submit" class="btn btn-primary btn-sm" onclick="geteditkomentanya({{ $komen->id  }})">Edit</button> 
                                            
                                            <form action="/komentanya/{{ $komen->id  }}" method="POST" class="d-inline-flex" >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data ?')">Delete</button> 
                                            </form>
                                        </div>
                                        @endif
                                        {{-- Btas Owner Edit Delete Jawabn --}}
                                    </div>
                                </div>
                                @endforeach
                                {{-- Batas Looping Komentar Jawaban --}}

                                {{-- Create Komentar Perrtanyaan --}}
                                <div class="col-sm-12 mb-3">
                                    <div class="card border-info">
                                        <div class="card-body">
                                            <h6>Komen Pertanyaan</h6>
                                            <form action="/komentanya/{{ $pertanyaan->id }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="description" id="my-editor" class="form-control  @error('description') is-invalid @enderror" placeholder="Tulis Komentar">{{old('description')}}</textarea>
                                                    @error('description')
                                                        <p class="alert alert-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <button class="btn btn-primary btn-block btn-sm float-right">Komen</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Batas Create Komentar Perrtanyaan --}}

                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-footer">
                    
                    <button type="button" onclick="SetvoteTanya({{ $pertanyaan->id }}, 1)" class="btn btn-primary btn-sm" ><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
                    <label id="votetanya-{{ $pertanyaan->id }}">0</label>
                    <button type="button" onclick="SetvoteTanya({{ $pertanyaan->id }}, -1)" class="btn btn-primary btn-sm" ><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
                    
                    <i class="float-right p-1">Ditanyakan tgl : {{$pertanyaan->created_at->format('d-m-Y : h:i:sa')}}</i>
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
                    {{-- komentar --}}
                    <div id="accordion">
                        <div class="card border-dark bg-info">
                            <div class="card-header" class="collapsed card-link" data-toggle="collapse" href="#listjawab-{{$jawaban->id}}">
                              Komentar
                            </a>
                            </div>
                            <div id="listjawab-{{$jawaban->id}}" class="collapse" data-parent="#accordion">
                                {{-- Looping Komentar Jawaban --}}
                                @foreach ($jawaban->komen_jawabs as $komen)
                                <div class="card-body">
                                    <div class="col-sm-12" >
                                        <div class="card border-dark">
                                            <div class="card-body">
                                                <h6>Komentar dari : <label id="komenjawabuser-{{$komen->id}}"> {{$komen->user->name}}</label></h6>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                       <label id="komenjawabdesc-{{$komen->id}}" >{!! $komen->description !!}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Owner Edit Delete Komen --}}
                                        @if ($komen->author())
                                        <div class="card-footer">
                                            {{-- <button><a href="/komenjawab/{{ $komen->id  }}/edit">Edit</a></button> --}}
                                            <button type="submit" class="btn btn-primary btn-sm" onclick="geteditkomenjawab({{ $komen->id  }})">Edit</button> 
                                            <form action="/komenjawab/{{ $komen->id  }}" method="POST" class="d-inline-flex" >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data ?')">Delete</button> 
                                            </form>
                                        </div>
                                        @endif
                                        {{-- Btas Owner Edit Delete Jawabn --}}
                                    </div>
                                    
                                </div>
                                @endforeach
                                {{-- Batas Looping Komentar Jawaban --}}


                                {{-- Create Komentar Perrtanyaan --}}
                                <div class="col-sm-12 mb-3">
                                    <div class="card border-info">
                                        <div class="card-body">
                                            <h6>Komen Jawaban</h6>
                                            <form action="/komenjawab/{{ $jawaban->id }}/{{ $pertanyaan->slug }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="description" id="my-editor" class="form-control  @error('description') is-invalid @enderror" placeholder="Tulis Komentar">{{old('description')}}</textarea>
                                                    @error('description')
                                                        <p class="alert alert-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <button class="btn btn-primary btn-block btn-sm float-right">Komen</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Batas Create Komentar Perrtanyaan --}}

                            </div>
                        </div>
                    </div>

                    {{-- Owner Edit Delete Jawabn --}}
                    @if ($jawaban->author())
                    <div class="card-footer">
                        <button type="button" onclick="SetvoteJawab({{ $jawaban->id }}, 1)" class="btn btn-primary btn-sm" ><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
                        <label id="votejawab-{{ $jawaban->id }}">0</label>
                        <button type="button" onclick="SetvoteJawab({{ $jawaban->id }}, -1)" class="btn btn-primary btn-sm" ><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
                        <button><a href="/jawaban/{{ $jawaban->id  }}/edit">Edit</a></button>
                        <form action="/jawaban/{{ $jawaban->id  }}" method="POST" class="d-inline-flex" >
                            @csrf
                            @method('DELETE')
                               <button type="submit" onclick="return confirm('Hapus Data ?')">Delete</button> 
                        </form>
                    </div>
                    @endif
                    {{-- Btas Owner Edit Delete Jawabn --}}
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

         {{-- Create Jawbabn --}}
        <div class="col-sm-12 mb-3">
            @if (!$pertanyaan->author())
            <div class="card border-info">
                <div class="card-body">
                    <h4>Jawab Pertanyaan</h4>
                    <form action="/jawaban/{{$pertanyaan->id}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="description"  class="form-control  ckeditor @error('description') is-invalid @enderror" placeholder="Tulis Pertanyaan">{{old('description')}}</textarea>

                            @error('description')
                                <p class="alert alert-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-block btn-sm float-right">Jawab</button>
                    </form>
                </div>
            </div>
        </div>
         {{-- END Create Jawbabn --}}

        @endif
    </section>
</div>


<div class="modal fade" id="komentanyadiag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Komentar Pertanyaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <input type="hidden" id="komentanyaidEdit">
            <h6>Komentar dari : <label id="userkomentanyaEdit"></label></h6>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Isi Komentar:</label>
            <textarea class="form-control" id="komendesctanyaEdit"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="btsavetanyaedit" >Simpan</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="komenjawabdiag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Komentar Jawaban</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <input type="hidden" id="komenjawabidEdit">
              <h6>Komentar dari : <label id="komenjawabuserEdit"></label></h6>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Isi Komentar:</label>
              <textarea class="form-control" id="komenjawabdescEdit"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="btsavejawabedit" >Simpan</button>
        </div>
      </div>
    </div>
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
        CKEDITOR.replace('.ckeditor', options);
        $(document).ready(function() {
            $('#btsavetanyaedit').on('click', function() { 
                submitformEditTanya();
            });
            $('#btsavejawabedit').on('click', function() { 
                submitformEditJawab();
            });

            
        });
        
        function submitformEditTanya(){
            var id = $("#komentanyaidEdit").val();
            $.ajax({
                url: "/komentanya/"+id,
                type: "PUT",
                dataType: 'json',
                data:{ 
                    _token:'{{ csrf_token() }}',
                    id : $("#komentanyaidEdit").val(),
                    description : $("#komendesctanyaEdit").val(),
                },
                cache: false,
                success: function(dataResult){
                    console.log(dataResult);
                    var resultData = dataResult.data;
                    if(dataResult.statusCode==200){
                        $("#komendesctanya-"+id).text(dataResult.obj["description"]);
                        alert(dataResult.msg);
                        $("#komentanyadiag").modal('hide');
                    }else{
                        alert("Error occured !");
                    }
                }
            });
        }

        function submitformEditJawab(){
            var id = $("#komenjawabidEdit").val();
            $.ajax({
                url: "/komenjawab/"+id,
                type: "PUT",
                dataType: 'json',
                data:{ 
                    _token:'{{ csrf_token() }}',
                    id : id,
                    description : $("#komenjawabdescEdit").val(),
                },
                cache: false,
                success: function(dataResult){
                    console.log(dataResult);
                    var resultData = dataResult.data;
                    if(dataResult.statusCode==200){
                        $("#komenjawabdesc-"+id).text(dataResult.obj["description"]);
                        alert(dataResult.msg);
                        $("#komenjawabdiag").modal('hide');
                    }else{
                        alert("Error occured !");
                    }
                }
            });
        }
        

        function geteditkomentanya(id){
            
           $("#komentanyaidEdit").val(id);
           $("#userkomentanyaEdit").text($("#userkomentanya-"+id).text());
           $("#komendesctanyaEdit").val($("#komendesctanya-"+id).text());

           $("#komentanyadiag").modal('show');
        };


        function geteditkomenjawab(id){
            $("#komenjawabidEdit").val(id);
            $("#komenjawabuserEdit").text($("#komenjawabuser-"+id).text());
            $("#komenjawabdescEdit").val($("#komenjawabdesc-"+id).text());
 
            $("#komenjawabdiag").modal('show');
         };

         function SetvoteJawab(id, val){
            $.ajax({
                url: "/votejawab/"+id,
                type: "POST",
                dataType: 'json',
                data:{ 
                    _token:'{{ csrf_token() }}',
                    nilai : val,
                },
                cache: false,
                success: function(dataResult){
                    console.log(dataResult);
                    var resultData = dataResult.data;
                    if(dataResult.statusCode==200){
                        alert(dataResult.msg);
                        $("#votejawab-"+id).text(dataResult.nilai);
                    }else{
                        alert("Error occured !");
                    }
                }
            });
         }


         function SetvoteTanya(id, val){
            $.ajax({
                url: "/votetanya/"+id,
                type: "POST",
                dataType: 'json',
                data:{ 
                    _token:'{{ csrf_token() }}',
                    nilai : val,
                },
                cache: false,
                success: function(dataResult){
                    console.log(dataResult);
                    var resultData = dataResult.data;
                    if(dataResult.statusCode==200){
                        alert(dataResult.msg);
                        $("#votetanya-"+id).text(dataResult.nilai);
                    }else{
                        alert("Error occured !");
                    }
                }
            });
         }
    </script>
@endpush

@endsection
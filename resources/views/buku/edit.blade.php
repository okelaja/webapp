@extends('master.app')
@section('navigasi')
<nav class="mt-3" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url('/dashboard') }}">
                <i class="fa fa-home"></i> Home
            </a>
        </li>
        <li class="breadcrumb-item" aria-current="page">
           <a href="{{ route('buku') }}">Buku</a> </li>
        <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
    </ol>
</nav>
@endsection
@section('judul')
    <h3>Edit Data</h3>
@endsection 
@section('konten')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 order-md-1 order-last">
                <div style="float: right">
                    <a href="{{ route('buku') }}">
                    <button class="btn btn-warning mt-2">
                    <i class="fa fa-arrow-circle-left"></i> Kembali
                    </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content mt-4"> 
        <section class="section">
            <div class="row" id="basic-table">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                              
                                {{-- ini wajib ada kalau mau ngirim file, tambahin ini :  enctype="multipart/form-data" --}}
                                <form action="{{route('buku.update',$show['id'])}}" enctype="multipart/form-data" method="POST">
                                    @method('PUT')
                                    @csrf
                                   <div class="row mt-2">
                                        <div class="col">
                                            <label for="basicInput">Judul Buku <small class="text-danger">*</small></label>
                                            <input type="text"  value="{{$show['judul']}}" name="judul" class="form-control  @error('judul') is-invalid @enderror" id="basicInput">
                                            @error('judul')
                                                <p>{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="basicInput">Penulis <small class="text-danger">*</small></label>
                                            <input type="text" value="{{$show['penulis']}}" name="penulis" class="form-control  @error('penulis') is-invalid @enderror" id="basicInput">
                                            @error('penulis')
                                                <p>{{$message}}</p>
                                            @enderror
                                        </div>
                                   </div>
                                   <div class="row mt-3">
                                        <div class="col">
                                            <label for="basicInput">Kategori <small class="text-danger">*</small></label>
                                            <select class="form-select @error('kategori') is-invalid @enderror" value="{{$show['kategori']}}" name="kategori" aria-label="Default select example">
                                                <option hidden></option>
                                                @foreach ($kategori as $item)
                                                    <option @selected($item->id == $show->kategori_id ) value="{{$item->id}}">{{$item->kategori}}</option> 
                                                @endforeach
                                                @error('kategori')
                                                    <p>{{$message}}</p>
                                                @enderror  
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="basicInput">Sampul Bulu <small>Max.999 kB</small></label>
                                                @if ($item->sampul)
                                                    <small class="text-danger">Kosongkan Jika tidak ada gambar</small>
                                                @endif
                                            <img src="{{ asset('upload')."/" .$item->sampul }}" alt="" class="w-25 img-fluid">
                                            <input type="file" value="" name="sampul" class="form-control @error('sampul') is-invalid @enderror" id="inputGroupFile02">
                                                @error('sampul')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror                                  
                                        </div>
                                    </div>
                                      <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" value="{{$show['deskripsi']}}" name="deskripsi" id="exampleFormControlTextarea1" rows="7">{{$show['deskripsi']}}</textarea>
                                      </div>
                                    <button class="btn btn-primary mt-3" type="submit">
                                        <i class="fa fa-refresh "></i> Update
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
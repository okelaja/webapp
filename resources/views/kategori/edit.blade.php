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
           <a href="{{ route('kategori') }}">Kategori</a> </li>
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
            <div class="col-7 order-md-1 order-last">
                <div style="float: right">
                    <a href="{{ route('kategori') }}">
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
                <div class="col-12 col-md-7">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{route('kategori.update',$kategori['id'])}}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label for="basicInput">Nama kategori</label>
                                        <input type="text" value="{{$kategori['kategori']}}" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" id="basicInput" placeholder="Masukkan nama kategori">
                                        @error('nama_kategori')
                                            <p>{{$message}}</p>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary mt-3">
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
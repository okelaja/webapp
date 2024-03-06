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
        <li class="breadcrumb-item active" aria-current="page">{{$show->judul}}</li>
    </ol>
</nav>
@endsection
@section('judul')
    <h3>Lihat Data</h3>
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
    <div class="col-12 col-xl-12 mt-4">
        <div class="card">
            <div class="card-body">
                <div class="page-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="w-75" src="{{asset('upload/'. $show->sampul) }}" alt="" style="border-radius: 10px">
                        </div>
                        <div class="col-md-8" style="margin-left: -5%">
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <tr>
                                        <th>Judul</th>
                                        <td>{{$show->judul}}</td>
                                    </tr>
                                    <tr>
                                        <th>Penulis</th>
                                        <td>{{$show->penulis}}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>{{$show->category->kategori}}</td>
                                    </tr>
                                    <tr>
                                        <th>tangal</th>
                                        <td>{{$show->created_at->now()->isoFormat('dddd, D MMMM Y')}}</td>
                                    </tr>
                                    <tr>
                                        <th>Created</th>
                                        <td>{{$show->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>Update</th>
                                        <td>{{$show->updated_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{{$show->deskripsi}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
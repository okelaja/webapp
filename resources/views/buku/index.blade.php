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
    </ol>
</nav>
@endsection
@section('judul')
    <h3>Data Buku</h3>
@endsection
@section('konten')
<div class="row">
    <div class="col-6">
        <a href="{{route('buku.create')}}">
          <button type="button" class="btn btn-warning"><i class="fa fa-plus-circle pe-2"></i>Tambah Data</button>
        </a>
    </div>
    <div class="col-6">
        <form action="" method="get">
            <div class="input-group mb-3">
                <input type="search"  placeholder="Search..." class="form-control">
                <button  class="btn btn-success">
                    <i class="fa fa-search"></i>Cari
                </button>
            </div>
        </form>
    </div>
</div>
<div class="col-12 col-xl-12 mt-3">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive"><table class="table table-hover table-lg">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sampul</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th style="width: 40%">Deskripsi</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp 
                    @foreach ($buku as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>
                            <div class="avatar">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('upload')."/" .$item->sampul }}">
                                </div>
                            </div>
                        </td>
                        <td>{{$item->judul}}</td>
                        <td>{{$item->penulis}}</td>
                        {{-- jika ingin menampilkan nama kategorinya maka : {{$item->categori->kategori}} 
                             category dari model buku--}}
                        <td>{{$item->category->kategori}}</td>
                        {{-- sintax ini buat membatasi tulisan kebih dari 100 huruf --}}
                        <td>
                            @if (Str::length($item->deskripsi) > 100)
                            {{ substr($item->deskripsi, 0, 100) }}...
                            @else
                                {{ $item->deskripsi }}
                            @endif
                        </td>
                        <td class="button text-end">
                          <a href="{{route('buku.show',$item->id) }}" class="btn btn-primary">
                              <i class="bi bi-info-circle"></i>
                          </a>
                          <a href="{{route('buku.edit',$item->id) }}" class="btn btn-warning">
                              <i class="bi bi-pencil"></i>
                          </a>
                          <a href="{{route('buku.delete',$item->id) }}"  onclick="return confirm('Ah Yang bener mau di hapus?')" class="btn btn-danger">
                              <i class="bi bi-trash"></i>
                          </a>
                        </td>
                      </tr> 
                    @endforeach
                 
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

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
    </ol>
</nav>
@endsection
@section('judul')
    <h3>Data Kategori</h3>
@endsection
@section('konten')

<div class="row">
    <div class="col-6">
        @if (Auth::user()->role == 'admin')
            <a href="{{route('kategori.create')}}">
                <button type="button" class="btn btn-warning"><i class="fa fa-plus-circle pe-2"></i>Tambah Data</button>
            </a>
        @endif
    </div>
    <div class="col-6">
        <form action="{{route('kategori')}}" method="get">
            <div class="input-group mb-3">
                <input type="search" name="search" placeholder="Search..." class="form-control">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-search"></i>Cari
                </button>
            </div>
        </form>
    </div>
</div>
<div class="row mt-3">
    
    {{-- kalau data berhasil dii simpan makan akan tampil pesan berikut --}}
    {{-- @if (session('status'))
    <div class="alert alert-success alert-dismissible show fade">
        <i class="fa fa-check-circle"></i>
        {{(session('status'))}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif --}}

    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                {{-- {{$cari}} --}}
                <div class="table-responsive">
                    <table class="table table-hover table-lg">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                        </thead>
                            <tbody>
                                {{-- @php
                                    $no = 1;
                                @endphp --}}
                                @foreach ($data as $kategori)
                                {{-- ini pake syintax elequent --}}
                                {{-- <tr>
                                    <td>{{$no++}}</td>
                                    <td> {{$kategori['kategori']}}</td>
                                    <td class="button text-end">
                                        <a href="{{route('kategori.show',$kategori['id'])}}" class="btn btn-primary">
                                            <i class="bi bi-info-circle"></i>
                                        </a>
                                        <a href="{{route('kategori.edit',$kategori['id'])}}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{route('kategori.delete',$kategori['id'])}}" onclick="return confirm('are you sure')" class="btn btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr> --}}

                                {{-- - ini pake syintaxs query builder --}}
                                <tr>
                                    <td>{{++$no;}}</td>
                                    <td> {{$kategori->kategori}}</td>
                                    <td class="button text-end">
                                    <a href="{{route('kategori.show',$kategori->id) }}" class="btn btn-primary">
                                        <i class="bi bi-info-circle"></i>
                                    </a>
                                        @if (Auth::user()->role == 'admin')
                                            <a href="{{route('kategori.edit',$kategori->id) }}" class="btn btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="{{route('kategori.delete',$kategori->id) }}" onclick="return confirm('are you sure')" class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        {{-- <tfoot class="">
                            <td></td>
                            <td></td>
                            <td>{{ $data->withQueryString()->links() }}</td>
                        </tfoot> --}}
                    </table>
                {!!$data->withQueryString()->links('pagination::bootstrap-5')!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
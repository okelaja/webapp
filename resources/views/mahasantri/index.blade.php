@extends('template')
@section('konten')
<h2>Data Mahasantri </h2>
<form action="{{route('santri')}}" method="get">

    <input type="text" name="cari" id="">
    <button type="submit">Cari</button>
    
</form>

    <ul>
        @foreach ($mahasantri as $data) 
       {{-- jika di cari maka nampil sesuai inputan--}}
        @if ($cari == null)
        <li>{{$data['id']." ". $data['nama']}}</li>
        @elseif ($cari == $data['nama'])
        <li>{{$data['id']." ". $data['nama']}}</li>
        @endif
        @endforeach
    </ul>    
@endsection
        
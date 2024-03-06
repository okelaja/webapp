<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- cara 1 menggunakan css atau js --}}
    {{-- 
        <link rel="stylesheet" href="css/style.css"> 
    --}}
    {{-- cara 2 menggunakan css atau js --}}
    <link rel="stylesheet" href="{{asset('css')}}/style.css"> 
    <title>Document</title>
</head>
<body>
    <h1>Header Aplikasi</h1>
    {{-- yield bisa lebih dari satu karena yield itu sebagai penanda --}}
    @yield('konten')
    {{-- @yield('sidebar') --}}
    {{-- <div>
        <p>Ini Tampilan Dashboard</p>
    </div> --}}
    <h6>Footer Aplikasi</h6>
</body>
</html>
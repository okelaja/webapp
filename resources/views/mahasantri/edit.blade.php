<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- Menampilkan Detail Data By ID --}}
    <h1>ID Mahasantri</h1>

    @foreach ($users as $user)
        @if ($idd == $user['id'])
            <p>
                ID : {{$user['id']}} 
            </p>
            <P>
                Nama :  {{$user['nama']}}
            </P>
        @endif
    @endforeach
</body>
</html>
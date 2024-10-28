<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    ini dashboard karyawan
    <br>
    <a href="{{ route('karyawan.proses-logout') }}">Logout</a>
    <br>
    {{ auth()->guard('karyawan')->user()->nama_user }}
</body>
</html>

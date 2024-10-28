<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Login Mahasiswa</h1>
    <form action="{{ route('mahasiswa.proses-login') }}" method="post">
        @csrf
        <label for="">NIM</label><br>
        <input type="text" name="nim"><br><br>
        <label for="">Password</label><br>
        <input type="text" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

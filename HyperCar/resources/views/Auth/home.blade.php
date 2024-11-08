<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Bem-vindo a HyperCar</h1>
    <p>Entre ou cadastre-se</p>
    <!-- Botões para login e registro -->
     <a href="{{ route('login') }}">Login</a> <br>
     <a href="{{ route('register') }}">Registro</a>
</body>
</html>

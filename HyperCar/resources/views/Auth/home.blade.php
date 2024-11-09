<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/generic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AuthCss/home.css') }}">
</head>
<body>
    <header>
        <h1>Bem-vindo a HyperCar</h1>
    </header>
    <main>
        <h2 class="about">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus velit error ut cum modi! Corrupti deleniti cum beatae, nisi sit molestiae sequi veniam, ullam quo voluptate assumenda laboriosam aut commodi.</h2>
        <section class="sign">
            <p>Entre ou cadastre-se</p>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Registro</a>
        </section>
    </main>
</body>
</html>

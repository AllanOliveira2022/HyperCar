{{-- resources/views/admin/home.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="{{ asset('css/generic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminCss/admin.css') }}">
</head>
<body>
    <h1>Bem-vindo ao Painel de Administração</h1>

    <!-- Link para a listagem de carros -->
    <div>
        <a href="{{ route('admin.carros.index') }}">Listar Carros</a>
    </div>

    <!-- Botão para criar novo carro -->
    <div style="margin-top: 20px;">
        <a href="{{ route('admin.carros.create') }}" class="btn btn-primary">Cadastrar Novo Carro</a>
    </div>

    <!-- Mensagens de Sucesso -->
    @if(session('success'))
        <div style="color: green; margin-top: 20px;">
            {{ session('success') }}
        </div>
    @endif
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Carros</title>
    <link rel="stylesheet" href="{{ asset('css/generic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminCss/cadastrar_carro.css') }}">
</head>
<body>
<form action="{{ route('admin.carros.store') }}" method="POST">
    <div class="buttons">
    <h1>Cadastro de Carros</h1>
    </div>
    @csrf

    <!-- Exibição de erros -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Exibição de mensagem de sucesso ou erro -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Campos do formulário -->
    <label for="Modelo">Modelo:</label>
    <input type="text" name="Modelo" value="{{ old('Modelo') }}" required>

    <label for="Tipo">Tipo:</label>
    <input type="text" name="Tipo" value="{{ old('Tipo') }}" required>

    <label for="Disponibilidade">Disponibilidade:</label>
    <select name="Disponibilidade" required>
        <option value="1" {{ old('Disponibilidade', 1) == 1 ? 'selected' : '' }}>Disponível</option>
        <option value="0" {{ old('Disponibilidade') == 0 ? 'selected' : '' }}>Indisponível</option>
    </select>

    <label for="Placa">Placa:</label>
    <input type="text" name="Placa" value="{{ old('Placa') }}" required>

    <label for="Quilometragem">Quilometragem:</label>
    <input type="number" name="Quilometragem" value="{{ old('Quilometragem') }}" required>

    <!-- Novo campo para Ano de Fabricação -->
    <label for="AnoFabricacao">Ano de Fabricação:</label>
    <input type="number" name="AnoFabricacao" value="{{ old('AnoFabricacao') }}" required min="1900" max="{{ date('Y') }}">

    <label for="PrecoDiaria">Preço por Diária:</label>
    <input type="number" name="PrecoDiaria" step="0.01" value="{{ old('PrecoDiaria') }}" required>

    <div class="buttons">
        <a href="{{ route('admin') }}" class="btn btn-primary">Voltar</a>
        <button type="submit">Cadastrar</button>
    </div>
</form>

</body>
</html>

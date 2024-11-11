<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Carros</title>
    <link rel="stylesheet" href="{{ asset('css/AdminCss/generic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminCss/mostrarcarro.css') }}">
</head>
<body>

<a href="{{ route('admin') }}" class="btn-primary">Voltar</a>
<h1>Lista de Carros</h1>

<!-- Seção de filtros removida -->

<div class="cards-container">
    @foreach($carros as $carro)
    <div class="card">
        <div class="card-header">{{ $carro->Modelo }}</div>
        <div class="card-content">
            <p class="disponibilidade {{ $carro->Disponibilidade ? 'disponivel' : 'indisponivel' }}">
                <strong>Disponibilidade:</strong> {{ $carro->Disponibilidade ? 'Disponível' : 'Indisponível' }}
            </p>
            <p><strong>Ano:</strong> {{ $carro->AnoFabricacao }}</p>
            <p><strong>Placa:</strong> {{ $carro->Placa }}</p>
            <p><strong>Quilometragem:</strong> {{ $carro->Quilometragem }}</p>
            <p><strong>Preço Diária:</strong> R$ {{ $carro->PrecoDiaria }}</p>
        </div>
        <div class="card-actions">
            <a href="{{ route('admin.carros.edit', $carro->IdCarro) }}">Editar</a>
            <form action="{{ route('admin.carros.destroy', $carro->IdCarro) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este carro?')">Excluir</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

</body>
</html>

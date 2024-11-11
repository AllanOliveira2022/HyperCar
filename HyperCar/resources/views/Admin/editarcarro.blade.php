<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carro</title>
    <link rel="stylesheet" href="{{ asset('css/AdminCss/editar.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Carro</h1>
        </header>

        <section class="form-container">
            <form action="{{ route('admin.carros.update', $carro->IdCarro) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="Modelo">Modelo:</label>
                    <input type="text" name="Modelo" value="{{ old('Modelo', $carro->Modelo) }}" required>
                </div>

                <div class="form-group">
                    <label for="Tipo">Tipo:</label>
                    <input type="text" name="Tipo" value="{{ old('Tipo', $carro->Tipo) }}" required>
                </div>

                <div class="form-group">
                    <label for="Disponibilidade">Disponibilidade:</label>
                    <select name="Disponibilidade" required>
                        <option value="1" {{ old('Disponibilidade', $carro->Disponibilidade) == 1 ? 'selected' : '' }}>Disponível</option>
                        <option value="0" {{ old('Disponibilidade', $carro->Disponibilidade) == 0 ? 'selected' : '' }}>Indisponível</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Placa">Placa:</label>
                    <input type="text" name="Placa" value="{{ old('Placa', $carro->Placa) }}" required>
                </div>

                <div class="form-group">
                    <label for="Quilometragem">Quilometragem:</label>
                    <input type="number" name="Quilometragem" value="{{ old('Quilometragem', $carro->Quilometragem) }}" required>
                </div>

                <div class="form-group">
                    <label for="PrecoDiaria">Preço por Diária:</label>
                    <input type="number" name="PrecoDiaria" step="0.01" value="{{ old('PrecoDiaria', $carro->PrecoDiaria) }}" required>
                </div>

                <!-- Novo campo para Ano de Fabricação -->
                <div class="form-group">
                    <label for="AnoFabricacao">Ano de Fabricação:</label>
                    <input type="number" name="AnoFabricacao" value="{{ old('AnoFabricacao', $carro->AnoFabricacao) }}" required>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.carros.index') }}">Voltar</a>
                    <button type="submit">Salvar Alterações</button>
                </div>
            </form>
        </section>
    </div>
</body>
</html>

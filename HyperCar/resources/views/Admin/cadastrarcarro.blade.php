<form action="{{ route('admin.carros.store') }}" method="POST">
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

    <label for="PrecoDiaria">Preço por Diária:</label>
    <input type="number" name="PrecoDiaria" step="0.01" value="{{ old('PrecoDiaria') }}" required>

    <button type="submit">Cadastrar Carro</button>
</form>

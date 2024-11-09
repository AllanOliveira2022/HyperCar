<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Veículo</title>
    <link rel="stylesheet" href="{{ asset('css/generic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ClienteCss/reservas.css') }}">
</head>
<body>
    <header>
        <h1>Reservar Veículo</h1>
    </header>

    <main>
        <!-- Mostrar mensagem de sucesso -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Mostrar mensagem de erro -->
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Mostrar erros de validação -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário de reserva -->
        <form action="{{ route('reservas.store') }}" method="POST">
            @csrf
            <div>
                <label for="IdCarro">Selecione um Veículo:</label>
                <select name="IdCarro" id="IdCarro" required onchange="mostrarIdSelecionado()">
                    @foreach ($carrosDisponiveis as $carro)
                        <option value="{{ $carro->IdCarro }}" {{ old('IdCarro') == $carro->IdCarro ? 'selected' : '' }}>
                            {{ $carro->Modelo }} - R$ {{ $carro->PrecoDiaria }} / dia
                        </option>
                    @endforeach
                </select>
                @error('IdCarro')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="DataInicio">Data de Início:</label>
                <input type="date" name="DataInicio" id="DataInicio" required value="{{ old('DataInicio') }}">
                @error('DataInicio')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="DataFim">Data de Fim:</label>
                <input type="date" name="DataFim" id="DataFim" required value="{{ old('DataFim') }}">
                @error('DataFim')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit">Reservar</button>
            </div>
        </form>

        <!-- Exibir o ID do carro selecionado -->
        <div>
            <p>ID do carro selecionado: <span id="idCarroSelecionado">Nenhum</span></p>
        </div>
        @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
    </main>

    <footer>
        <!-- Conteúdo do rodapé -->
    </footer>

    <!-- Script para mostrar o ID do carro selecionado -->
    <script>
        function mostrarIdSelecionado() {
            const selectElement = document.getElementById('IdCarro');
            const idCarroSelecionado = selectElement.options[selectElement.selectedIndex].value;
            document.getElementById('idCarroSelecionado').innerText = idCarroSelecionado;
        }

        // Exibir o ID já selecionado, se houver
        window.onload = mostrarIdSelecionado;
    </script>
</body>
</html>
